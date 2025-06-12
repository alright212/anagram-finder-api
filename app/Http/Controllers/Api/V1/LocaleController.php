<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Middleware\LocaleMiddleware;
use App\Traits\TranslatesApiMessages;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LocaleController extends Controller
{
    use TranslatesApiMessages;

    /**
     * Get locale information and supported languages
     * 
     * @OA\Get(
     *     path="/api/v1/locale/info",
     *     operationId="getLocaleInfo",
     *     tags={"Locale"},
     *     summary="Get locale information",
     *     description="Returns information about supported locales and current locale settings",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(property="current_locale", type="string", example="en"),
     *                 @OA\Property(property="supported_locales", type="array", @OA\Items(type="string"), example={"en", "et", "de", "fr"}),
     *                 @OA\Property(property="default_locale", type="string", example="en"),
     *                 @OA\Property(
     *                     property="locale_detection_methods",
     *                     type="object",
     *                     @OA\Property(property="query_parameter", type="string", example="lang or locale"),
     *                     @OA\Property(property="custom_header", type="string", example="X-Locale"),
     *                     @OA\Property(property="accept_language", type="string", example="Accept-Language header")
     *                 )
     *             )
     *         )
     *     )
     * )
     */
    public function info(): JsonResponse
    {
        $localeInfo = LocaleMiddleware::getLocaleInfo();
        
        return $this->localizedResponse([
            'data' => $localeInfo,
            'message' => $this->trans('welcome')
        ]);
    }

    /**
     * Get translations for a specific namespace
     * 
     * @OA\Get(
     *     path="/api/v1/locale/translations/{namespace}",
     *     operationId="getTranslations",
     *     tags={"Locale"},
     *     summary="Get translations for namespace",
     *     description="Returns all translations for a specific namespace in the current locale",
     *     @OA\Parameter(
     *         name="namespace",
     *         in="path",
     *         description="Translation namespace (e.g., api, validation)",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *             example="api"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="locale",
     *         in="query",
     *         description="Override locale for this request",
     *         required=false,
     *         @OA\Schema(
     *             type="string",
     *             example="et"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(property="namespace", type="string", example="api"),
     *                 @OA\Property(property="locale", type="string", example="en"),
     *                 @OA\Property(
     *                     property="translations",
     *                     type="object",
     *                     description="Translation key-value pairs"
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Namespace not found",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="error",
     *                 type="object",
     *                 @OA\Property(property="message", type="string", example="Translation namespace not found"),
     *                 @OA\Property(property="code", type="string", example="NAMESPACE_NOT_FOUND")
     *             )
     *         )
     *     )
     * )
     */
    public function translations(Request $request, string $namespace): JsonResponse
    {
        // Override locale if specified in query
        $locale = $request->query('locale', App::getLocale());
        
        // Validate locale
        if (!in_array($locale, LocaleMiddleware::getSupportedLocales())) {
            return $this->errorResponse(
                'validation.invalid_encoding',
                'INVALID_LOCALE',
                400,
                ['attribute' => 'locale']
            );
        }

        // Get translations for the namespace
        $translations = $this->getNamespaceTranslations($namespace, $locale);
        
        if ($translations === null) {
            return $this->errorResponse(
                'not_found',
                'NAMESPACE_NOT_FOUND',
                404
            );
        }

        return $this->localizedResponse([
            'data' => [
                'namespace' => $namespace,
                'locale' => $locale,
                'translations' => $translations
            ]
        ]);
    }

    /**
     * Set locale preference (example endpoint for future session support)
     * 
     * @OA\Post(
     *     path="/api/v1/locale/preference",
     *     operationId="setLocalePreference",
     *     tags={"Locale"},
     *     summary="Set locale preference",
     *     description="Set the preferred locale for future requests (requires session/auth implementation)",
     *     @OA\RequestBody(
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="locale",
     *                 type="string",
     *                 description="Preferred locale code",
     *                 example="et"
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Preference set successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Locale preference updated"),
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(property="locale", type="string", example="et"),
     *                 @OA\Property(property="previous_locale", type="string", example="en")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid locale",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="error",
     *                 type="object",
     *                 @OA\Property(property="message", type="string", example="Unsupported locale"),
     *                 @OA\Property(property="code", type="string", example="INVALID_LOCALE")
     *             )
     *         )
     *     )
     * )
     */
    public function setPreference(Request $request): JsonResponse
    {
        $request->validate([
            'locale' => 'required|string|size:2'
        ]);

        $newLocale = $request->input('locale');
        $currentLocale = App::getLocale();

        // Validate locale
        if (!in_array($newLocale, LocaleMiddleware::getSupportedLocales())) {
            return $this->errorResponse(
                'validation.invalid_encoding',
                'INVALID_LOCALE',
                400,
                ['attribute' => 'locale']
            );
        }

        // For now, just return success - in a real app, you'd save to session/user preferences
        return $this->successResponse(
            'success',
            [
                'locale' => $newLocale,
                'previous_locale' => $currentLocale,
                'note' => 'Preference saved for demonstration. Implement session/auth for persistence.'
            ]
        );
    }

    /**
     * Get all available translations for debugging
     */
    public function debug(): JsonResponse
    {
        if (!config('app.debug')) {
            return $this->errorResponse(
                'error',
                'DEBUG_DISABLED',
                403
            );
        }

        $supportedLocales = LocaleMiddleware::getSupportedLocales();
        $allTranslations = [];

        foreach ($supportedLocales as $locale) {
            $allTranslations[$locale] = [
                'api' => $this->getNamespaceTranslations('api', $locale),
                'validation' => $this->getNamespaceTranslations('validation', $locale)
            ];
        }

        return $this->localizedResponse([
            'data' => [
                'supported_locales' => $supportedLocales,
                'current_locale' => App::getLocale(),
                'all_translations' => $allTranslations,
                'debug_info' => $this->getLocaleDebugInfo()
            ]
        ]);
    }

    /**
     * Get translations for a specific namespace and locale
     */
    private function getNamespaceTranslations(string $namespace, string $locale): ?array
    {
        $filePath = resource_path("lang/{$locale}/{$namespace}.php");
        
        if (!file_exists($filePath)) {
            return null;
        }

        return include $filePath;
    }
}
