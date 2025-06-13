<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\WordbaseImportRequest;
use App\Services\WordbaseImportService;
use App\Traits\TranslatesApiMessages;
use Illuminate\Http\JsonResponse;

class WordbaseController extends Controller
{
    use TranslatesApiMessages;

    private WordbaseImportService $importService;

    public function __construct(WordbaseImportService $importService)
    {
        $this->importService = $importService;
    }

    /**
     * Import wordbase from Estonian word list
     * 
     * @OA\Post(
     *     path="/api/v1/wordbase/import",
     *     operationId="importWordbase",
     *     tags={"Wordbase"},
     *     summary="Import wordbase",
     *     description="Import words from Estonian word list into the database",
     *     @OA\RequestBody(
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="force",
     *                 type="boolean",
     *                 description="Force reimport even if wordbase already exists",
     *                 example=false
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Wordbase already exists",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Wordbase import completed"),
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(property="words_imported", type="integer", example=0),
     *                 @OA\Property(property="timestamp", type="string", format="date-time")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Wordbase imported successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Wordbase import completed"),
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(property="words_imported", type="integer", example=50000),
     *                 @OA\Property(property="timestamp", type="string", format="date-time")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=409,
     *         description="Wordbase already exists",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="error",
     *                 type="object",
     *                 @OA\Property(property="message", type="string", example="Wordbase already exists"),
     *                 @OA\Property(property="code", type="string", example="WORDBASE_EXISTS")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Import failed",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="error",
     *                 type="object",
     *                 @OA\Property(property="message", type="string", example="Import failed"),
     *                 @OA\Property(property="code", type="string", example="IMPORT_FAILED")
     *             )
     *         )
     *     )
     * )
     * 
     * POST /api/v1/wordbase/import
     */
    public function import(WordbaseImportRequest $request): JsonResponse
    {
        // Check if this is a custom word import or default import
        if ($request->isCustomImport()) {
            return $this->importCustomWords($request);
        } else {
            return $this->importDefaultWordbase($request);
        }
    }

    /**
     * Import custom words provided by the user
     */
    private function importCustomWords(WordbaseImportRequest $request): JsonResponse
    {
        $words = $request->input('words');
        $format = $request->input('format', 'text');
        $language = $request->input('language', 'et');

        // Parse words based on format
        $wordArray = [];
        if ($format === 'json') {
            $decoded = json_decode($words, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                return $this->errorResponse(
                    'Invalid JSON format',
                    'INVALID_JSON',
                    400
                );
            }
            $wordArray = is_array($decoded) ? $decoded : [$decoded];
        } else {
            // Text format - split by lines, spaces, or commas
            $wordArray = preg_split('/[\r\n,\s]+/', trim($words), -1, PREG_SPLIT_NO_EMPTY);
        }

        // Import the custom words
        $result = $this->importService->importCustomWords($wordArray, $language);

        if ($result['success']) {
            $responseData = [
                'words_imported' => $result['words_imported'],
                'duplicates_skipped' => $result['duplicates_skipped'] ?? 0,
                'total_processed' => count($wordArray),
                'timestamp' => now()->toISOString(),
            ];

            return $this->successResponse(
                'wordbase.custom_import_completed',
                $responseData,
                201,
                ['count' => $result['words_imported']]
            );
        }

        return $this->errorResponse(
            'wordbase.import_failed',
            'IMPORT_FAILED',
            500
        );
    }

    /**
     * Import default Estonian wordbase
     */
    private function importDefaultWordbase(WordbaseImportRequest $request): JsonResponse
    {
        // Validate request parameters
        $force = $request->boolean('force', false);

        // Perform import
        $result = $this->importService->importWordbase($force);

        // Return appropriate HTTP status based on result
        if ($result['success']) {
            $responseData = [
                'words_imported' => $result['words_imported'],
                'timestamp' => now()->toISOString(),
            ];

            // Choose message based on whether words were actually imported
            $messageKey = $result['words_imported'] > 0 ? 'wordbase.import_completed' : 'wordbase.already_exists';
            $status = $result['words_imported'] > 0 ? 201 : 200;

            return $this->successResponse(
                $messageKey,
                $responseData,
                $status,
                ['count' => $result['words_imported']]
            );
        }

        // Handle different types of failures
        if (str_contains($result['message'], 'already exists')) {
            return $this->errorResponse(
                'wordbase.already_exists',
                'WORDBASE_EXISTS',
                409
            );
        }

        return $this->errorResponse(
            'wordbase.import_failed',
            'IMPORT_FAILED',
            500
        );
    }

    /**
     * Get wordbase status
     * 
     * @OA\Get(
     *     path="/api/v1/wordbase/status",
     *     operationId="getWordbaseStatus",
     *     tags={"Wordbase"},
     *     summary="Get wordbase import status",
     *     description="Returns the current status of the wordbase including import information",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(property="is_imported", type="boolean", example=true),
     *                 @OA\Property(property="total_words", type="integer", example=50000),
     *                 @OA\Property(property="last_import_date", type="string", format="date-time", example="2025-06-12T10:30:00Z"),
     *                 @OA\Property(property="file_size", type="string", example="2.5 MB")
     *             )
     *         )
     *     )
     * )
     * 
     * GET /api/v1/wordbase/status
     */
    public function status(): JsonResponse
    {
        $status = $this->importService->getImportStatus();

        // Add localized status information
        $localizedStatus = $this->localizeWordbaseStatus($status);

        return $this->localizedResponse([
            'data' => $localizedStatus,
            'message' => $this->transWordbase('status_check')
        ]);
    }

    /**
     * Add localized labels to wordbase status
     */
    private function localizeWordbaseStatus(array $status): array
    {
        $localized = $status;
        
        // Add localized status messages
        if (isset($status['wordbase_exists'])) {
            $localized['status_message'] = $status['wordbase_exists'] 
                ? $this->transWordbase('cleared') 
                : $this->transWordbase('empty');
        }
        
        if (isset($status['word_count']) && $status['word_count'] > 0) {
            $localized['import_message'] = $this->transWordbase('words_imported', ['count' => $status['word_count']]);
        }

        return $localized;
    }
}
