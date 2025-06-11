<?php

namespace App\Repositories;

interface WordRepositoryInterface
{
    /**
     * Add a single word to the wordbase
     */
    public function addWord(string $originalWord, string $canonicalForm, int $length): void;

    /**
     * Find anagrams for a given canonical form
     */
    public function findAnagrams(string $canonicalForm, ?string $wordToExclude = null): array;

    /**
     * Store multiple words in batch for performance
     */
    public function storeWordbase(array $wordsData): bool;

    /**
     * Clear the entire wordbase
     */
    public function clearWordbase(): void;

    /**
     * Check if wordbase is empty
     */
    public function isWordbaseEmpty(): bool;

    /**
     * Get total word count
     */
    public function getWordCount(): int;

    /**
     * Get comprehensive statistics about the wordbase
     */
    public function getStatistics(): array;

    /**
     * Get words containing Unicode characters (Estonian specific)
     */
    public function getUnicodeWords(int $limit = 100): array;
}
