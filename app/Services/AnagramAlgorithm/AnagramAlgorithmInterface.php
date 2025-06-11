<?php

namespace App\Services\AnagramAlgorithm;

interface AnagramAlgorithmInterface
{
    /**
     * Generate canonical form for anagram detection
     * All words that are anagrams will have the same canonical form
     */
    public function generateCanonical(string $word): string;

    /**
     * Clear any internal caches for memory management
     */
    public function clearCache(): void;
}
