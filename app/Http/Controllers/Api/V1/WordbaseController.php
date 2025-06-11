<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\WordbaseImportRequest;
use App\Services\WordbaseImportService;
use Illuminate\Http\JsonResponse;

class WordbaseController extends Controller
{
    private WordbaseImportService $importService;

    public function __construct(WordbaseImportService $importService)
    {
        $this->importService = $importService;
    }

    /**
     * Import wordbase from Estonian word list
     * POST /api/v1/wordbase/import
     */
    public function import(WordbaseImportRequest $request): JsonResponse
    {
        // Validate request parameters
        $force = $request->boolean('force', false);

        // Perform import
        $result = $this->importService->importWordbase($force);

        // Return appropriate HTTP status based on result
        if ($result['success']) {
            return response()->json([
                'message' => $result['message'],
                'data' => [
                    'words_imported' => $result['words_imported'],
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
     * Get wordbase status
     * GET /api/v1/wordbase/status
     */
    public function status(): JsonResponse
    {
        $status = $this->importService->getImportStatus();

        return response()->json([
            'data' => $status
        ]);
    }
}
