<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Services\AnagramService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class AnagramController extends Controller
{
    private AnagramService $anagramService;

    public function __construct(AnagramService $anagramService)
    {
        $this->anagramService = $anagramService;
    }

    /**
     * Find anagrams for a given word
     * GET /api/v1/anagrams/{word}
     */
    public function show(string $word): JsonResponse
    {
        try {
            // Basic validation
            if (empty(trim($word))) {
                return response()->json([
                    'error' => [
                        'message' => 'Word parameter cannot be empty',
                        'code' => 'INVALID_WORD'
                    ]
                ], 400);
            }

            // Check if wordbase is ready
            if (!$this->anagramService->isWordbaseReady()) {
                return response()->json([
                    'error' => [
                        'message' => 'Wordbase not available. Please import wordbase first.',
                        'code' => 'WORDBASE_NOT_READY'
                    ]
                ], 503); // Service Unavailable
            }

            // Validate word length (reasonable limits)
            if (mb_strlen($word, 'UTF-8') > 100) {
                return response()->json([
                    'error' => [
                        'message' => 'Word too long. Maximum length is 100 characters.',
                        'code' => 'WORD_TOO_LONG'
                    ]
                ], 400);
            }

            // Find anagrams with metadata
            $result = $this->anagramService->findAnagramsWithMetadata($word);

            return response()->json([
                'data' => $result
            ]);

        } catch (\InvalidArgumentException $e) {
            Log::error('Anagram search failed', [
                'word' => $word,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'error' => [
                    'message' => $e->getMessage(),
                    'code' => 'INVALID_INPUT'
                ]
            ], 400);
        }
    }

    /**
     * Get statistics about the anagram service
     * GET /api/v1/anagrams/stats
     */
    public function stats(): JsonResponse
    {
        $stats = $this->anagramService->getWordbaseStats();

        return response()->json([
            'data' => $stats
        ]);
    }
}
