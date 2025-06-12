<?php

namespace App\Services;

use App\Repositories\WordRepositoryInterface;
use App\Services\AnagramAlgorithm\AnagramAlgorithmInterface;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WordbaseImportService
{
    private const WORDLIST_URL = 'https://www.opus.ee/lemmad2013.txt';
    private const BATCH_SIZE = 500; // Smaller batches for Heroku memory limits
    
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
     * Import wordbase from the Estonian word list with memory optimization
     */
    public function importWordbase(bool $clearExisting = false): array
    {
        try {
            Log::info('Starting wordbase import (streaming)', [
                'clear_existing' => $clearExisting,
                'memory_limit' => ini_get('memory_limit'),
                'batch_size' => self::BATCH_SIZE
            ]);

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
            $response = Http::timeout(60)->get(self::WORDLIST_URL);
            
            if (!$response->successful()) {
                throw new \Exception('Failed to fetch wordlist: HTTP ' . $response->status());
            }

            $content = $response->body();
            if (empty($content)) {
                throw new \Exception('Wordlist content is empty');
            }

            // Process in batches to avoid memory exhaustion
            $totalImported = $this->processWordlistInBatches($content);

            Log::info('Wordbase import completed', ['words_imported' => $totalImported]);

            return [
                'success' => true,
                'message' => "Successfully imported {$totalImported} words",
                'words_imported' => $totalImported,
            ];

        } catch (\Exception $e) {
            Log::error('Wordbase import failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'memory_usage' => memory_get_usage(true),
                'peak_memory' => memory_get_peak_usage(true)
            ]);

            return [
                'success' => false,
                'message' => 'Import failed: ' . $e->getMessage(),
                'words_imported' => 0,
            ];
        }
    }

    /**
     * Process wordlist in batches to avoid memory exhaustion
     */
    private function processWordlistInBatches(string $content): int
    {
        $lines = explode("\n", $content);
        $totalImported = 0;
        $batch = [];
        $processedWords = [];

        Log::info('Starting batch processing', ['total_lines' => count($lines), 'batch_size' => self::BATCH_SIZE]);

        foreach ($lines as $line) {
            $word = trim($line);
            if (empty($word)) {
                continue;
            }

            $batch[] = $word;

            // Process batch when it reaches the desired size
            if (count($batch) >= self::BATCH_SIZE) {
                $processed = $this->processBatch($batch);
                if (!empty($processed)) {
                    $success = $this->wordRepository->storeWordbase($processed);
                    if ($success) {
                        $totalImported += count($processed);
                        Log::info('Processed batch', ['batch_size' => count($processed), 'total_imported' => $totalImported]);
                    } else {
                        throw new \Exception('Failed to store batch in database');
                    }
                }
                
                // Clear batch and processed words to free memory
                $batch = [];
                $processed = [];
                
                // Force garbage collection to free memory
                if (function_exists('gc_collect_cycles')) {
                    gc_collect_cycles();
                }
            }
        }

        // Process remaining words in the last batch
        if (!empty($batch)) {
            $processed = $this->processBatch($batch);
            if (!empty($processed)) {
                $success = $this->wordRepository->storeWordbase($processed);
                if ($success) {
                    $totalImported += count($processed);
                    Log::info('Processed final batch', ['batch_size' => count($processed), 'total_imported' => $totalImported]);
                } else {
                    throw new \Exception('Failed to store final batch in database');
                }
            }
        }

        return $totalImported;
    }

    /**
     * Process a batch of words
     */
    private function processBatch(array $words): array
    {
        $processedWords = [];
        $uniqueWords = array_unique($words); // Remove duplicates within batch

        foreach ($uniqueWords as $word) {
            try {
                // Skip words that are too short (less than 2 characters)
                if (mb_strlen($word, 'UTF-8') < 2) {
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
            }
        }

        return $processedWords;
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
