<?php

namespace App\Services;

use App\Repositories\WordRepositoryInterface;
use App\Services\AnagramAlgorithm\AnagramAlgorithmInterface;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WordbaseImportService
{
    private const WORDLIST_URL = 'https://www.opus.ee/lemmad2013.txt';
    
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
     * Import wordbase from the Estonian word list
     */
    public function importWordbase(bool $clearExisting = false): array
    {
        try {
            Log::info('Starting wordbase import', ['clear_existing' => $clearExisting]);

            if ($clearExisting) {
                $this->wordRepository->clearWordbase();
                Log::info('Cleared existing wordbase');
            } elseif (!$this->wordRepository->isWordbaseEmpty()) {
                return [
                    'success' => false,
                    'message' => 'Wordbase already exists. Use force=true to overwrite.',
                    'words_imported' => 0,
                ];
            }

            // Fetch word list from URL
            $response = Http::timeout(30)->get(self::WORDLIST_URL);
            
            if (!$response->successful()) {
                throw new \Exception('Failed to fetch wordlist: HTTP ' . $response->status());
            }

            $content = $response->body();
            if (empty($content)) {
                throw new \Exception('Wordlist content is empty');
            }

            // Parse and process words
            $words = $this->parseWordlist($content);
            $processedWords = $this->processWords($words);

            // Store in database
            $success = $this->wordRepository->storeWordbase($processedWords);

            if (!$success) {
                throw new \Exception('Failed to store words in database');
            }

            $importedCount = count($processedWords);
            Log::info('Wordbase import completed', ['words_imported' => $importedCount]);

            return [
                'success' => true,
                'message' => "Successfully imported {$importedCount} words",
                'words_imported' => $importedCount,
            ];

        } catch (\Exception $e) {
            Log::error('Wordbase import failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return [
                'success' => false,
                'message' => 'Import failed: ' . $e->getMessage(),
                'words_imported' => 0,
            ];
        }
    }

    /**
     * Parse wordlist content into individual words
     */
    private function parseWordlist(string $content): array
    {
        // Split by lines and filter out empty lines
        $lines = explode("\n", $content);
        $words = [];

        foreach ($lines as $line) {
            $word = trim($line);
            if (!empty($word)) {
                $words[] = $word;
            }
        }

        return array_unique($words); // Remove duplicates
    }

    /**
     * Process words to generate canonical forms and calculate lengths
     */
    private function processWords(array $words): array
    {
        $processedWords = [];
        $skippedCount = 0;

        foreach ($words as $word) {
            try {
                // Skip words that are too short (less than 2 characters)
                if (mb_strlen($word, 'UTF-8') < 2) {
                    $skippedCount++;
                    continue;
                }

                // Generate canonical form
                $canonicalForm = $this->anagramAlgorithm->generateCanonical($word);
                
                // Calculate Unicode-aware length
                $length = mb_strlen($word, 'UTF-8');

                $processedWords[] = [
                    'original_word' => $word,
                    'canonical_form' => $canonicalForm,
                    'length' => $length,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];

            } catch (\Exception $e) {
                Log::warning('Failed to process word', [
                    'word' => $word,
                    'error' => $e->getMessage()
                ]);
                $skippedCount++;
            }
        }

        if ($skippedCount > 0) {
            Log::info('Skipped words during processing', ['skipped_count' => $skippedCount]);
        }

        return $processedWords;
    }

    /**
     * Get import status
     */
    public function getImportStatus(): array
    {
        return [
            'wordbase_exists' => !$this->wordRepository->isWordbaseEmpty(),
            'word_count' => $this->wordRepository->getWordCount(),
            'source_url' => self::WORDLIST_URL,
        ];
    }
}
