<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class LocaleMiddleware
{
    /**
     * Supported locales for the API
     */
    private const SUPPORTED_LOCALES = ['en', 'et', 'de', 'fr'];

    /**
     * Default locale fallback
     */
    private const DEFAULT_LOCALE = 'en';

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $locale = $this->determineLocale($request);
        
        // Set the application locale
        App::setLocale($locale);
        
        // Log locale selection for debugging
        Log::debug('Locale set for request', [
            'locale' => $locale,
            'url' => $request->url(),
            'user_agent' => $request->header('User-Agent'),
            'accept_language' => $request->header('Accept-Language')
        ]);

        $response = $next($request);

        // Add locale information to response headers
        $response->headers->set('Content-Language', $locale);
        $response->headers->set('X-API-Locale', $locale);
        $response->headers->set('X-Available-Locales', implode(',', self::SUPPORTED_LOCALES));

        return $response;
    }

    /**
     * Determine the best locale for the request
     */
    private function determineLocale(Request $request): string
    {
        // 1. Check for explicit locale parameter
        $paramLocale = $request->query('lang') ?? $request->query('locale');
        if ($paramLocale && $this->isSupportedLocale($paramLocale)) {
            return $paramLocale;
        }

        // 2. Check custom header (X-Locale)
        $headerLocale = $request->header('X-Locale');
        if ($headerLocale && $this->isSupportedLocale($headerLocale)) {
            return $headerLocale;
        }

        // 3. Parse Accept-Language header
        $acceptLanguage = $request->header('Accept-Language');
        if ($acceptLanguage) {
            $preferredLocale = $this->parseAcceptLanguageHeader($acceptLanguage);
            if ($preferredLocale) {
                return $preferredLocale;
            }
        }

        // 4. Check if Estonian users (based on various heuristics)
        if ($this->isLikelyEstonianUser($request)) {
            return 'et';
        }

        // 5. Fallback to default locale
        return self::DEFAULT_LOCALE;
    }

    /**
     * Check if a locale is supported
     */
    private function isSupportedLocale(string $locale): bool
    {
        // Normalize locale (e.g., 'et-EE' -> 'et')
        $normalizedLocale = strtolower(substr($locale, 0, 2));
        return in_array($normalizedLocale, self::SUPPORTED_LOCALES);
    }

    /**
     * Parse Accept-Language header and return best matching locale
     */
    private function parseAcceptLanguageHeader(string $acceptLanguage): ?string
    {
        // Parse Accept-Language header format: en-US,en;q=0.9,et;q=0.8
        $languages = [];
        
        // Split by comma and parse each language preference
        foreach (explode(',', $acceptLanguage) as $lang) {
            $parts = explode(';', trim($lang));
            $locale = trim($parts[0]);
            $quality = 1.0; // Default quality

            // Parse quality value if present
            if (count($parts) > 1 && strpos($parts[1], 'q=') === 0) {
                $quality = floatval(substr($parts[1], 2));
            }

            // Normalize locale code
            $normalizedLocale = strtolower(substr($locale, 0, 2));
            
            if ($this->isSupportedLocale($normalizedLocale)) {
                $languages[$normalizedLocale] = $quality;
            }
        }

        if (empty($languages)) {
            return null;
        }

        // Sort by quality in descending order
        arsort($languages);

        // Return the highest quality supported locale
        return array_key_first($languages);
    }

    /**
     * Determine if user is likely Estonian based on various heuristics
     */
    private function isLikelyEstonianUser(Request $request): bool
    {
        // Check if the request contains Estonian characters in any parameter
        $allParams = array_merge(
            $request->query->all(),
            $request->request->all(),
            [$request->getPathInfo()]
        );

        foreach ($allParams as $value) {
            if (is_string($value) && $this->containsEstonianCharacters($value)) {
                return true;
            }
        }

        // Check User-Agent for Estonian-specific patterns
        $userAgent = $request->header('User-Agent', '');
        if (stripos($userAgent, 'estonia') !== false || 
            stripos($userAgent, 'tallinn') !== false ||
            stripos($userAgent, 'tartu') !== false) {
            return true;
        }

        return false;
    }

    /**
     * Check if text contains Estonian-specific characters
     */
    private function containsEstonianCharacters(string $text): bool
    {
        return preg_match('/[äöüõšž]/u', $text) === 1;
    }

    /**
     * Get available locales for API documentation
     */
    public static function getSupportedLocales(): array
    {
        return self::SUPPORTED_LOCALES;
    }

    /**
     * Get locale information for API responses
     */
    public static function getLocaleInfo(): array
    {
        return [
            'supported_locales' => self::SUPPORTED_LOCALES,
            'default_locale' => self::DEFAULT_LOCALE,
            'current_locale' => App::getLocale(),
            'locale_detection_methods' => [
                'query_parameter' => 'lang or locale',
                'custom_header' => 'X-Locale',
                'accept_language' => 'Accept-Language header',
                'content_detection' => 'Estonian character detection',
                'fallback' => 'Default locale'
            ]
        ];
    }
}
