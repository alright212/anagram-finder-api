<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\WordbaseImportRequest;
use App\Services\AdvancedWordbaseImportService;
use Illuminate\Http\JsonResponse;

class AdvancedWordbaseController extends Controller
{
    private AdvancedWordbaseImportService $importService;

    public function __construct(AdvancedWordbaseImportService $importService)
    {
        $this->importService = $importService;
    }

    /**
     * Import wordbase with advanced Unicode processing
     * POST /api/v1/advanced/wordbase/import
     */
    public function import(WordbaseImportRequest $request): JsonResponse
    {
        // Validate request parameters
        $force = $request->boolean('force', false);

        // Perform advanced import
        $result = $this->importService->importWordbase($force);

        // Return appropriate HTTP status based on result
        if ($result['success']) {
            return response()->json([
                'message' => $result['message'],
                'data' => [
                    'words_imported' => $result['words_imported'],
                    'statistics' => $result['statistics'] ?? null,
                    'timestamp' => now()->toISOString(),
                ]
            ], $result['words_imported'] > 0 ? 201 : 200);
        }

        // Handle different types of failures
        if (str_contains($result['message'], 'already exists')) {
            return response()->json([
                'error' => [
                    'message' => $result['message'],
                    'code' => 'WORDBASE_EXISTS'
                ]
            ], 409); // Conflict
        }

        return response()->json([
            'error' => [
                'message' => $result['message'],
                'code' => 'IMPORT_FAILED'
            ]
        ], 500);
    }

    /**
     * Get advanced wordbase status with Unicode statistics
     * GET /api/v1/advanced/wordbase/status
     */
    public function status(): JsonResponse
    {
        $status = $this->importService->getAdvancedImportStatus();

        return response()->json([
            'data' => $status
        ]);
    }
}
