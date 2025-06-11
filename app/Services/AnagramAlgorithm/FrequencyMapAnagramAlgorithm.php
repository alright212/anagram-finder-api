<?php

namespace App\Services\AnagramAlgorithm;

class FrequencyMapAnagramAlgorithm implements AnagramAlgorithmInterface
{
    /**
     * Generate canonical form using character frequency mapping
     * This approach counts occurrences of each character
     */
    public function generateCanonical(string $word): string
    {
        // Ensure UTF-8 encoding
        if (!mb_check_encoding($word, 'UTF-8')) {
            throw new \InvalidArgumentException('Input word must be valid UTF-8');
        }

        $lowerCaseWord = mb_strtolower($word, 'UTF-8');
        $charCounts = [];
        
        // Count character frequencies
        $length = mb_strlen($lowerCaseWord, 'UTF-8');
        for ($i = 0; $i < $length; $i++) {
            $char = mb_substr($lowerCaseWord, $i, 1, 'UTF-8');
            $charCounts[$char] = ($charCounts[$char] ?? 0) + 1;
        }

        // Sort characters for consistent ordering
        ksort($charCounts, SORT_STRING | SORT_FLAG_CASE);

        // Build canonical string: char + count for each character
        $canonical = '';
        foreach ($charCounts as $char => $count) {
            $canonical .= $char . $count;
        }

        return $canonical;
    }

    /**
     * Clear any internal caches for memory management
     * This algorithm doesn't use caching, so this is a no-op
     */
    public function clearCache(): void
    {
        // No caching in this algorithm, nothing to clear
    }
}
