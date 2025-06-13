<?php

namespace App\Services;

use App\Repositories\WordRepositoryInterface;
use App\Services\AnagramAlgorithm\AnagramAlgorithmInterface;
use Illuminate\Support\Facades\Log;

class AnagramService
{
    private WordRepositoryInterface $wordRepository;
    private AnagramAlgorithmInterface $anagramAlgorithm;

    public function __construct(
        WordRepositoryInterface $wordRepository,
        AnagramAlgorithmInterface $anagramAlgorithm
    ) {
        $this->wordRepository = $wordRepository;
        $this->anagramAlgorithm = $anagramAlgorithm;
    }

    /**
     * Check if wordbase is ready for use
     */
    public function isWordbaseReady(): bool
    {
        return !$this->wordRepository->isWordbaseEmpty();
    }

    /**
     * Find anagrams for a given word with detailed metadata
     */
    public function findAnagramsWithMetadata(string $word): array
    {
        try {
            // Generate canonical form for the input word
            $canonicalForm = $this->anagramAlgorithm->generateCanonical($word);
            
            // Find anagrams (excluding the input word itself)
            $anagrams = $this->wordRepository->findAnagrams($canonicalForm, $word);
            
            // Calculate metadata
            $wordLength = mb_strlen($word, 'UTF-8');
            $hasUnicode = preg_match('/[^\x00-\x7F]/', $word) === 1;
            $isEstonianChars = preg_match('/[äöüõšž]/u', $word) === 1;
            
            return [
                'original_word' => $word,
                'canonical_form' => $canonicalForm,
                'anagrams' => $anagrams,
                'count' => count($anagrams),
                'word_length' => $wordLength,
                'has_unicode' => $hasUnicode,
                'is_estonian_chars' => $isEstonianChars
            ];
            
        } catch (\Exception $e) {
            Log::error('Failed to find anagrams', [
                'word' => $word,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            throw new \InvalidArgumentException('Failed to process word: ' . $e->getMessage());
        }
    }

    /**
     * Find anagrams for a given word (simple version)
     */
    public function findAnagrams(string $word): array
    {
        $canonicalForm = $this->anagramAlgorithm->generateCanonical($word);
        return $this->wordRepository->findAnagrams($canonicalForm, $word);
    }

    /**
     * Get comprehensive wordbase statistics
     */
    public function getWordbaseStats(): array
    {
        try {
            $stats = $this->wordRepository->getStatistics();
            
            // Add algorithm-specific cache stats if available
            $algorithmStats = $this->getAlgorithmStats();
            if (!empty($algorithmStats)) {
                $stats['algorithm_cache'] = $algorithmStats;
            }
            
            return $stats;
            
        } catch (\Exception $e) {
            Log::error('Failed to get wordbase stats', [
                'error' => $e->getMessage()
            ]);
            
            return [
                'error' => 'Failed to retrieve statistics',
                'total_words' => 0,
                'wordbase_exists' => false
            ];
        }
    }

    /**
     * Get algorithm performance metrics
     */
    public function getAlgorithmStats(): array
    {
        $stats = [
            'algorithm' => get_class($this->anagramAlgorithm)
        ];
        
        // Check if the algorithm supports cache statistics
        if (method_exists($this->anagramAlgorithm, 'getCacheStats')) {
            try {
                $cacheStats = call_user_func([$this->anagramAlgorithm, 'getCacheStats']);
                $stats = array_merge($stats, $cacheStats);
                $stats['caching_enabled'] = true;
            } catch (\Exception $e) {
                $stats['caching_enabled'] = false;
                $stats['cache_error'] = $e->getMessage();
            }
        } else {
            $stats['caching_enabled'] = false;
        }
        
        return $stats;
    }

    /**
     * Clear algorithm cache for memory management
     */
    public function clearAlgorithmCache(): void
    {
        if (method_exists($this->anagramAlgorithm, 'clearCache')) {
            $this->anagramAlgorithm->clearCache();
        }
    }

    /**
     * Validate if a word can be processed
     */
    public function validateWord(string $word): bool
    {
        try {
            // Check UTF-8 encoding
            if (!mb_check_encoding($word, 'UTF-8')) {
                return false;
            }
            
            // Check reasonable length limits
            $length = mb_strlen($word, 'UTF-8');
            if ($length < 1 || $length > 100) {
                return false;
            }
            
            // Try to generate canonical form
            $this->anagramAlgorithm->generateCanonical($word);
            
            return true;
            
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Get word processing metadata without finding anagrams
     */
    public function getWordMetadata(string $word): array
    {
        $canonicalForm = $this->anagramAlgorithm->generateCanonical($word);
        $wordLength = mb_strlen($word, 'UTF-8');
        $hasUnicode = preg_match('/[^\x00-\x7F]/', $word) === 1;
        $isEstonianChars = preg_match('/[äöüõšž]/u', $word) === 1;
        
        return [
            'original_word' => $word,
            'canonical_form' => $canonicalForm,
            'word_length' => $wordLength,
            'has_unicode' => $hasUnicode,
            'is_estonian_chars' => $isEstonianChars
        ];
    }

    /**
     * Get words with the most anagrams
     */
    public function getWordsWithMostAnagrams(int $limit = 10): array
    {
        try {
            return $this->wordRepository->getWordsWithMostAnagrams($limit);
        } catch (\Exception $e) {
            Log::error('Failed to get words with most anagrams', [
                'error' => $e->getMessage()
            ]);
            return [];
        }
    }
}
