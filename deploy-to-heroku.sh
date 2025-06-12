#!/bin/bash

# 🚀 Quick Heroku Deployment Script for Estonian Anagram Finder API

set -e  # Exit on any error

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

echo -e "${BLUE}🚀 Estonian Anagram Finder API - Heroku Deployment${NC}"
echo "=================================================="

# Check if Heroku CLI is installed
if ! command -v heroku &> /dev/null; then
    echo -e "${RED}❌ Heroku CLI is not installed. Please install it first:${NC}"
    echo "   curl https://cli-assets.heroku.com/install.sh | sh"
    exit 1
fi

# Check if user is logged in to Heroku
if ! heroku auth:whoami &> /dev/null; then
    echo -e "${YELLOW}⚠️  Please login to Heroku first:${NC}"
    heroku login
fi

# Get app name from user
read -p "Enter your Heroku app name (or press Enter to let Heroku generate one): " APP_NAME

# Create Heroku app
echo -e "${BLUE}📱 Creating Heroku app...${NC}"
if [ -z "$APP_NAME" ]; then
    heroku create | tee app_creation.log
    APP_NAME=$(grep -o 'https://[^.]*\.herokuapp\.com' app_creation.log | head -1 | sed 's/https:\/\///' | sed 's/\.herokuapp\.com//')
    rm -f app_creation.log
else
    heroku create "$APP_NAME"
fi

echo -e "${GREEN}✅ Created app: $APP_NAME${NC}"

# Set buildpack
echo -e "${BLUE}🔧 Setting PHP buildpack...${NC}"
heroku buildpacks:set heroku/php --app "$APP_NAME"

# Generate Laravel app key
echo -e "${BLUE}🔑 Generating Laravel app key...${NC}"
APP_KEY=$(php artisan key:generate --show)

# Set environment variables
echo -e "${BLUE}⚙️  Setting environment variables...${NC}"
heroku config:set \
    APP_NAME="Estonian Anagram Finder" \
    APP_ENV=production \
    APP_DEBUG=false \
    APP_KEY="$APP_KEY" \
    APP_URL="https://$APP_NAME.herokuapp.com" \
    DB_CONNECTION=sqlite \
    DB_DATABASE="/app/database/database.sqlite" \
    SESSION_DRIVER=database \
    CACHE_STORE=database \
    QUEUE_CONNECTION=database \
    LOG_CHANNEL=errorlog \
    LOG_STACK=single \
    LOG_LEVEL=info \
    --app "$APP_NAME"

# Commit changes if needed
echo -e "${BLUE}📦 Preparing code for deployment...${NC}"
if ! git diff --cached --quiet; then
    git add .
    git commit -m "Prepare for Heroku deployment"
fi

# Deploy to Heroku
echo -e "${BLUE}🚀 Deploying to Heroku...${NC}"
git push heroku main

# Run migrations
echo -e "${BLUE}🗄️  Running database migrations...${NC}"
heroku run php artisan migrate --force --app "$APP_NAME"

# Optional: Seed database
read -p "Do you want to seed the database with sample data? (y/N): " -n 1 -r
echo
if [[ $REPLY =~ ^[Yy]$ ]]; then
    echo -e "${BLUE}🌱 Seeding database...${NC}"
    heroku run php artisan db:seed --force --app "$APP_NAME"
fi

# Show app info
echo ""
echo -e "${GREEN}🎉 Deployment completed successfully!${NC}"
echo "=================================================="
echo -e "${BLUE}App Name:${NC} $APP_NAME"
echo -e "${BLUE}App URL:${NC} https://$APP_NAME.herokuapp.com"
echo -e "${BLUE}API Health Check:${NC} https://$APP_NAME.herokuapp.com/api/health"
echo ""
echo -e "${YELLOW}Useful commands:${NC}"
echo "  heroku logs --tail --app $APP_NAME"
echo "  heroku run php artisan route:list --app $APP_NAME"
echo "  heroku open --app $APP_NAME"
echo ""

# Test the deployed API
echo -e "${BLUE}🧪 Testing deployed API...${NC}"
sleep 5  # Give the app a moment to fully start

if curl -f -s "https://$APP_NAME.herokuapp.com/api/health" > /dev/null; then
    echo -e "${GREEN}✅ API is responding correctly!${NC}"
else
    echo -e "${YELLOW}⚠️  API might still be starting up. Check logs if needed:${NC}"
    echo "   heroku logs --tail --app $APP_NAME"
fi

echo ""
echo -e "${GREEN}🎉 Your Estonian Anagram Finder API is now live on Heroku!${NC}"
