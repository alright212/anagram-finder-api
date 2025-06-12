<?php

namespace App\Traits;

use Illuminate\Support\Facades\App;

trait TranslatesApiMessages
{
    /**
     * Translate an API message with parameters
     */
    protected function trans(string $key, array $parameters = [], ?string $locale = null): string
    {
        $locale = $locale ?? App::getLocale();
        
        // Ensure the key includes the api namespace
        if (!str_starts_with($key, 'api.')) {
            $key = 'api.' . $key;
        }

        return __($key, $parameters, $locale);
    }

    /**
     * Translate error message with code
     */
    protected function transError(string $messageKey, string $code, array $parameters = [], ?string $locale = null): array
    {
        return [
            'message' => $this->trans($messageKey, $parameters, $locale),
            'code' => $code
        ];
    }

    /**
     * Translate success response
     */
    protected function transSuccess(string $messageKey, array $data = [], array $parameters = [], ?string $locale = null): array
    {
        $response = [
            'message' => $this->trans($messageKey, $parameters, $locale),
            'data' => $data
        ];

        // Add locale information to successful responses
        $response['meta'] = [
            'locale' => $locale ?? App::getLocale(),
            'timestamp' => now()->toISOString()
        ];

        return $response;
    }

    /**
     * Get translated validation messages
     */
    protected function getValidationMessages(): array
    {
        return [
            'required' => $this->trans('validation.required'),
            'boolean' => $this->trans('validation.boolean'),
            'string' => $this->trans('validation.string'),
            'max' => $this->trans('validation.max_length'),
            'min' => $this->trans('validation.min_length'),
        ];
    }

    /**
     * Translate anagram-specific messages
     */
    protected function transAnagram(string $subKey, array $parameters = []): string
    {
        return $this->trans("anagrams.{$subKey}", $parameters);
    }

    /**
     * Translate wordbase-specific messages
     */
    protected function transWordbase(string $subKey, array $parameters = []): string
    {
        return $this->trans("wordbase.{$subKey}", $parameters);
    }

    /**
     * Translate advanced wordbase messages
     */
    protected function transAdvancedWordbase(string $subKey, array $parameters = []): string
    {
        return $this->trans("advanced_wordbase.{$subKey}", $parameters);
    }

    /**
     * Translate statistics messages
     */
    protected function transStats(string $subKey, array $parameters = []): string
    {
        return $this->trans("stats.{$subKey}", $parameters);
    }

    /**
     * Translate performance messages
     */
    protected function transPerformance(string $subKey, array $parameters = []): string
    {
        return $this->trans("performance.{$subKey}", $parameters);
    }

    /**
     * Translate algorithm messages
     */
    protected function transAlgorithm(string $subKey, array $parameters = []): string
    {
        return $this->trans("algorithm.{$subKey}", $parameters);
    }

    /**
     * Get error code translation
     */
    protected function transErrorCode(string $code): string
    {
        return $this->trans("error_codes.{$code}");
    }

    /**
     * Create a localized response with proper structure
     */
    protected function localizedResponse(array $data, int $status = 200, array $headers = []): \Illuminate\Http\JsonResponse
    {
        // Add locale metadata to all responses
        if (!isset($data['meta'])) {
            $data['meta'] = [];
        }

        $data['meta']['locale'] = App::getLocale();
        $data['meta']['timestamp'] = now()->toISOString();

        // Add locale headers
        $headers['Content-Language'] = App::getLocale();
        $headers['X-API-Locale'] = App::getLocale();

        return response()->json($data, $status, $headers);
    }

    /**
     * Format error response with localization
     */
    protected function errorResponse(string $messageKey, string $code, int $status = 400, array $parameters = []): \Illuminate\Http\JsonResponse
    {
        $data = [
            'error' => $this->transError($messageKey, $code, $parameters)
        ];

        return $this->localizedResponse($data, $status);
    }

    /**
     * Format success response with localization
     */
    protected function successResponse(string $messageKey, array $responseData = [], int $status = 200, array $parameters = []): \Illuminate\Http\JsonResponse
    {
        $data = $this->transSuccess($messageKey, $responseData, $parameters);
        return $this->localizedResponse($data, $status);
    }

    /**
     * Get current locale information for debugging
     */
    protected function getLocaleDebugInfo(): array
    {
        return [
            'current_locale' => App::getLocale(),
            'fallback_locale' => config('app.fallback_locale'),
            'available_locales' => ['en', 'et', 'de', 'fr'],
            'translation_namespace' => 'api'
        ];
    }
}
