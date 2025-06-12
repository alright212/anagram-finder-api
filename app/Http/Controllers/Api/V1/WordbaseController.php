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

        return response()->json([
            'data' => $status
        ]);
    }
}
