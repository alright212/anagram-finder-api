<?php

namespace App\Services\AnagramAlgorithm;

class SortingAnagramAlgorithm implements AnagramAlgorithmInterface
{
    /**
     * Generate canonical form by sorting characters alphabetically
     * This is Unicode-safe and handles Estonian characters correctly
     */
    public function generateCanonical(string $word): string
    {
        // Ensure UTF-8 encoding
        if (!mb_check_encoding($word, 'UTF-8')) {
            throw new \InvalidArgumentException('Input word must be valid UTF-8');
        }

        // Convert to lowercase for case-insensitive anagram detection
        $lowerCaseWord = mb_strtolower($word, 'UTF-8');

        // Split into characters using Unicode-aware method
        if (function_exists('grapheme_str_split')) {
            // Most robust for complex Unicode characters (requires PHP 8.3+ and intl extension)
            $characters = grapheme_str_split($lowerCaseWord);
        } else {
            // Fallback for older PHP versions or when intl extension is not available
            $characters = preg_split('//u', $lowerCaseWord, -1, PREG_SPLIT_NO_EMPTY);
            if ($characters === false) {
                throw new \RuntimeException('Failed to split word into characters');
            }
        }

        // Sort characters alphabetically
        sort($characters, SORT_STRING | SORT_FLAG_CASE);

        return implode('', $characters);
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
