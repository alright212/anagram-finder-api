# Use PHP 8.2 with Apache
FROM php:8.2-apache

# Set working directory
WORKDIR /var/www/html

# 1. INSTALL SYSTEM DEPENDENCIES AND PHP EXTENSIONS FIRST
# These layers will be cached because they rarely change
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libicu-dev \
    zip \
    unzip \
    sqlite3 \
    libsqlite3-dev \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions (this is the slow step that we want to cache)
# Using -j$(nproc) for parallel compilation to speed up the build
RUN docker-php-ext-install -j$(nproc) pdo_mysql pdo_sqlite mbstring exif pcntl bcmath gd intl

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 2. INSTALL COMPOSER DEPENDENCIES NEXT
# Copy only composer files first - this layer only rebuilds if composer.json/lock changes
COPY composer.json composer.lock ./

# Install PHP dependencies (this layer will be cached unless composer files change)
RUN composer install --no-interaction --no-plugins --no-scripts --no-dev --prefer-dist --optimize-autoloader

# 3. COPY APPLICATION CODE LAST
# This is the only layer that will rebuild frequently during development
COPY . /var/www/html

# Run post-install scripts after copying application files
RUN composer run-script post-autoload-dump

# Final composer optimization after copying all files
RUN composer dump-autoload --optimize

# Set permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage \
    && chmod -R 755 /var/www/html/bootstrap/cache

# Configure Apache
RUN a2enmod rewrite
COPY apache-config.conf /etc/apache2/sites-available/000-default.conf

# Create SQLite database file with proper permissions
RUN mkdir -p /var/www/html/database \
    && touch /var/www/html/database/database.sqlite \
    && chown www-data:www-data /var/www/html/database/database.sqlite \
    && chmod 664 /var/www/html/database/database.sqlite

# Expose port 80
EXPOSE 80

# Health check for production readiness
HEALTHCHECK --interval=30s --timeout=3s --start-period=60s --retries=3 \
    CMD curl -f http://localhost/ || exit 1

# Start Apache
CMD ["apache2-foreground"]
