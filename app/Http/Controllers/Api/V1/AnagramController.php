<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Services\AnagramService;
use App\Traits\TranslatesApiMessages;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class AnagramController extends Controller
{
    use TranslatesApiMessages;

    private AnagramService $anagramService;

    public function __construct(AnagramService $anagramService)
    {
        $this->anagramService = $anagramService;
    }

    /**
     * Find anagrams for a given word
     * 
     * @OA\Get(
     *     path="/api/v1/anagrams/{word}",
     *     operationId="findAnagrams",
     *     tags={"Anagrams"},
     *     summary="Find anagrams for a given word",
     *     description="Returns all anagrams found for the provided word along with metadata",
     *     @OA\Parameter(
     *         name="word",
     *         in="path",
     *         description="The word to find anagrams for",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *             maxLength=100,
     *             minLength=1,
     *             example="listen"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(property="word", type="string", example="listen"),
     *                 @OA\Property(property="anagrams", type="array", @OA\Items(type="string"), example={"silent", "enlist"}),
     *                 @OA\Property(property="count", type="integer", example=2),
     *                 @OA\Property(property="search_time_ms", type="number", format="float", example=12.5)
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad request",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="error",
     *                 type="object",
     *                 @OA\Property(property="message", type="string", example="Word parameter cannot be empty"),
     *                 @OA\Property(property="code", type="string", example="INVALID_WORD")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=503,
     *         description="Service unavailable",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="error",
     *                 type="object",
     *                 @OA\Property(property="message", type="string", example="Wordbase not available. Please import wordbase first."),
     *                 @OA\Property(property="code", type="string", example="WORDBASE_NOT_READY")
     *             )
     *         )
     *     )
     * )
     * 
     * GET /api/v1/anagrams/{word}
     */
    public function show(string $word): JsonResponse
    {
        try {
            // Basic validation
            if (empty(trim($word))) {
                return $this->errorResponse(
                    'anagrams.empty_word', 
                    'INVALID_WORD', 
                    400
                );
            }

            // Check if wordbase is ready
            if (!$this->anagramService->isWordbaseReady()) {
                return $this->errorResponse(
                    'anagrams.not_ready', 
                    'WORDBASE_NOT_READY', 
                    503
                );
            }

            // Validate word length (reasonable limits)
            if (mb_strlen($word, 'UTF-8') > 100) {
                return $this->errorResponse(
                    'anagrams.word_too_long', 
                    'WORD_TOO_LONG', 
                    400, 
                    ['max' => 100]
                );
            }

            // Find anagrams with metadata
            $result = $this->anagramService->findAnagramsWithMetadata($word);

            // Add localized success message
            $result['message'] = $this->transAnagram('search_completed');
            
            // Add performance message if search time is available
            if (isset($result['search_time_ms'])) {
                $result['performance_note'] = $this->transPerformance('search_time', ['time' => $result['search_time_ms']]);
            }

            return $this->localizedResponse(['data' => $result]);

        } catch (\InvalidArgumentException $e) {
            Log::error('Anagram search failed', [
                'word' => $word,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return $this->errorResponse(
                'anagrams.processing_error', 
                'INVALID_INPUT', 
                400, 
                ['word' => $word]
            );
        }
    }

    /**
     * Get statistics about the anagram service
     * 
     * @OA\Get(
     *     path="/api/v1/anagrams/stats",
     *     operationId="getAnagramStats",
     *     tags={"Anagrams"},
     *     summary="Get wordbase statistics",
     *     description="Returns statistics about the current wordbase including total words count",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(property="total_words", type="integer", example=50000),
     *                 @OA\Property(property="is_ready", type="boolean", example=true),
     *                 @OA\Property(property="last_updated", type="string", format="date-time", example="2025-06-12T10:30:00Z")
     *             )
     *         )
     *     )
     * )
     * 
     * GET /api/v1/anagrams/stats
     */
    public function stats(): JsonResponse
    {
        $stats = $this->anagramService->getWordbaseStats();

        // Add localized labels for statistics
        $localizedStats = $this->localizeStats($stats);
        
        return $this->localizedResponse([
            'data' => $localizedStats,
            'message' => $this->transStats('wordbase_ready') 
        ]);
    }

    /**
     * Add localized labels to statistics
     */
    private function localizeStats(array $stats): array
    {
        $localized = $stats;
        
        // Add localized descriptions for key statistics
        if (isset($stats['total_words'])) {
            $localized['total_words_label'] = $this->transStats('total_words');
        }
        
        if (isset($stats['unique_canonical_forms'])) {
            $localized['unique_canonical_forms_label'] = $this->transStats('unique_canonical_forms');
        }
        
        if (isset($stats['avg_length'])) {
            $localized['average_word_length_label'] = $this->transStats('average_word_length');
        }

        return $localized;
    }
}
