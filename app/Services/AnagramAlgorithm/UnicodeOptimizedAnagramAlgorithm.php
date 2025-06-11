<?php

namespace App\Services\AnagramAlgorithm;

class UnicodeOptimizedAnagramAlgorithm implements AnagramAlgorithmInterface
{
    private array $characterNormalizations;
    private array $canonicalCache;

    public function __construct()
    {
        $this->initializeCharacterNormalizations();
        $this->canonicalCache = [];
    }

    /**
     * Generate canonical form with advanced Unicode handling and optimizations
     */
    public function generateCanonical(string $word): string
    {
        // Cache check for performance
        $cacheKey = md5($word);
        if (isset($this->canonicalCache[$cacheKey])) {
            return $this->canonicalCache[$cacheKey];
        }

        // Ensure UTF-8 encoding
        if (!mb_check_encoding($word, 'UTF-8')) {
            throw new \InvalidArgumentException('Input word must be valid UTF-8');
        }

        // Normalize Unicode (NFD - Canonical Decomposition)
        $normalized = \Normalizer::normalize($word, \Normalizer::FORM_D);
        if ($normalized === false) {
            throw new \RuntimeException('Failed to normalize Unicode string');
        }

        // Convert to lowercase using proper Unicode case folding
        $lowerCase = mb_strtolower($normalized, 'UTF-8');

        // Apply Estonian-specific character normalizations
        $processedWord = $this->applyEstonianNormalizations($lowerCase);

        // Split into grapheme clusters (proper Unicode character handling)
        $characters = $this->splitIntoGraphemes($processedWord);

        // Sort characters with proper Unicode collation
        $this->sortUnicodeCharacters($characters);

        $canonical = implode('', $characters);

        // Cache the result for future lookups
        $this->canonicalCache[$cacheKey] = $canonical;

        return $canonical;
    }

    /**
     * Initialize Estonian-specific character normalizations
     */
    private function initializeCharacterNormalizations(): void
    {
        // Estonian diacritics mapping for better anagram matching
        $this->characterNormalizations = [
            'á' => 'a', 'à' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a',
            'é' => 'e', 'è' => 'e', 'ê' => 'e', 'ë' => 'e',
            'í' => 'i', 'ì' => 'i', 'î' => 'i', 'ï' => 'i',
            'ó' => 'o', 'ò' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'ø' => 'o',
            'ú' => 'u', 'ù' => 'u', 'û' => 'u', 'ü' => 'u',
            'ý' => 'y', 'ÿ' => 'y',
            'ñ' => 'n', 'ç' => 'c',
            'š' => 's', 'ž' => 'z',
            // Add more Estonian-specific mappings as needed
        ];
    }

    /**
     * Apply Estonian-specific normalizations
     */
    private function applyEstonianNormalizations(string $word): string
    {
        return strtr($word, $this->characterNormalizations);
    }

    /**
     * Split string into grapheme clusters (Unicode-aware character splitting)
     */
    private function splitIntoGraphemes(string $word): array
    {
        if (function_exists('grapheme_str_split')) {
            // Most robust method (requires PHP 8.3+ and intl extension)
            $characters = grapheme_str_split($word);
            if ($characters === false) {
                throw new \RuntimeException('Failed to split word into graphemes');
            }
            return $characters;
        }

        // Fallback using mb_str_split (available in PHP 7.4+)
        if (function_exists('mb_str_split')) {
            return mb_str_split($word, 1, 'UTF-8');
        }

        // Last resort fallback using preg_split
        $characters = preg_split('//u', $word, -1, PREG_SPLIT_NO_EMPTY);
        if ($characters === false) {
            throw new \RuntimeException('Failed to split word into characters');
        }

        return $characters;
    }

    /**
     * Sort Unicode characters with proper collation
     */
    private function sortUnicodeCharacters(array &$characters): void
    {
        // Use Collator for proper Unicode sorting if available
        if (class_exists('Collator')) {
            $collator = new \Collator('et_EE'); // Estonian locale
            if ($collator === null) {
                $collator = new \Collator('en_US'); // Fallback to English
            }
            
            if ($collator !== null) {
                $collator->sort($characters);
                return;
            }
        }

        // Fallback to basic sort with Unicode flag
        sort($characters, SORT_STRING | SORT_FLAG_CASE);
    }

    /**
     * Clear the canonical cache (useful for memory management)
     */
    public function clearCache(): void
    {
        $this->canonicalCache = [];
    }

    /**
     * Get cache statistics
     */
    public function getCacheStats(): array
    {
        return [
            'cached_items' => count($this->canonicalCache),
            'memory_usage' => memory_get_usage(true),
        ];
    }
}
