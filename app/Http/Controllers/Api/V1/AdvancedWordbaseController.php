<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\WordbaseImportRequest;
use App\Services\AdvancedWordbaseImportService;
use App\Traits\TranslatesApiMessages;
use Illuminate\Http\JsonResponse;

class AdvancedWordbaseController extends Controller
{
    use TranslatesApiMessages;

    private AdvancedWordbaseImportService $importService;

    public function __construct(AdvancedWordbaseImportService $importService)
    {
        $this->importService = $importService;
    }

    /**
     * Import wordbase with advanced Unicode processing
     * 
     * @OA\Post(
     *     path="/api/v1/advanced/wordbase/import",
     *     operationId="importAdvancedWordbase",
     *     tags={"Advanced Wordbase"},
     *     summary="Import wordbase with Unicode optimization",
     *     description="Import words from Estonian word list with advanced Unicode processing and optimization",
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
     *             @OA\Property(property="message", type="string", example="Advanced wordbase import completed"),
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(property="words_imported", type="integer", example=0),
     *                 @OA\Property(property="statistics", type="object", nullable=true),
     *                 @OA\Property(property="timestamp", type="string", format="date-time")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Advanced wordbase imported successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Advanced wordbase import completed"),
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(property="words_imported", type="integer", example=50000),
     *                 @OA\Property(
     *                     property="statistics",
     *                     type="object",
     *                     @OA\Property(property="unicode_words", type="integer", example=1200),
     *                     @OA\Property(property="ascii_words", type="integer", example=48800),
     *                     @OA\Property(property="processing_time_ms", type="number", format="float", example=2500.5)
     *                 ),
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
     *                 @OA\Property(property="message", type="string", example="Advanced import failed"),
     *                 @OA\Property(property="code", type="string", example="IMPORT_FAILED")
     *             )
     *         )
     *     )
     * )
     */
    public function import(WordbaseImportRequest $request): JsonResponse
    {
        // Validate request parameters
        $force = $request->boolean('force', false);

        // Perform advanced import
        $result = $this->importService->importWordbase($force);

        // Return appropriate HTTP status based on result
        if ($result['success']) {
            $responseData = [
                'words_imported' => $result['words_imported'],
                'statistics' => $this->localizeAdvancedStatistics($result['statistics'] ?? []),
                'timestamp' => now()->toISOString(),
            ];

            // Choose message based on whether words were actually imported
            $messageKey = $result['words_imported'] > 0 
                ? 'advanced_wordbase.unicode_processing' 
                : 'wordbase.already_exists';
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
            'advanced_wordbase.unicode_processing',
            'IMPORT_FAILED',
            500
        );
    }

    /**
     * Get advanced wordbase status with Unicode statistics
     * 
     * @OA\Get(
     *     path="/api/v1/advanced/wordbase/status",
     *     operationId="getAdvancedWordbaseStatus",
     *     tags={"Advanced Wordbase"},
     *     summary="Get advanced wordbase status",
     *     description="Returns detailed status of the advanced wordbase including Unicode processing statistics",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(property="is_imported", type="boolean", example=true),
     *                 @OA\Property(property="total_words", type="integer", example=50000),
     *                 @OA\Property(property="unicode_words", type="integer", example=1200),
     *                 @OA\Property(property="ascii_words", type="integer", example=48800),
     *                 @OA\Property(property="last_import_date", type="string", format="date-time", example="2025-06-12T10:30:00Z"),
     *                 @OA\Property(property="optimization_level", type="string", example="unicode_optimized"),
     *                 @OA\Property(property="file_size", type="string", example="2.5 MB")
     *             )
     *         )
     *     )
     * )
     */
    public function status(): JsonResponse
    {
        $status = $this->importService->getAdvancedImportStatus();

        // Add localized status information for advanced features
        $localizedStatus = $this->localizeAdvancedWordbaseStatus($status);

        return $this->localizedResponse([
            'data' => $localizedStatus,
            'message' => $this->transAdvancedWordbase('unicode_processing')
        ]);
    }

    /**
     * Add localized labels to advanced statistics
     */
    private function localizeAdvancedStatistics(array $statistics): array
    {
        if (empty($statistics)) {
            return $statistics;
        }

        $localized = $statistics;
        
        // Add Unicode-specific localized messages
        if (isset($statistics['unicode_words_found'])) {
            $localized['unicode_message'] = $this->transAdvancedWordbase(
                'unicode_words_found', 
                ['count' => $statistics['unicode_words_found']]
            );
        }

        if (isset($statistics['canonical_forms_generated'])) {
            $localized['canonical_message'] = $this->transAdvancedWordbase(
                'canonical_forms_generated',
                ['count' => $statistics['canonical_forms_generated']]
            );
        }

        return $localized;
    }

    /**
     * Add localized labels to advanced wordbase status
     */
    private function localizeAdvancedWordbaseStatus(array $status): array
    {
        $localized = $status;
        
        // Add advanced status messages
        if (isset($status['wordbase_exists']) && $status['wordbase_exists']) {
            $localized['advanced_status_message'] = $this->transAdvancedWordbase('estonian_optimization');
        }
        
        if (isset($status['unicode_words']) && $status['unicode_words'] > 0) {
            $localized['unicode_status'] = $this->transAdvancedWordbase(
                'unicode_words_found', 
                ['count' => $status['unicode_words']]
            );
        }

        return $localized;
    }
}
