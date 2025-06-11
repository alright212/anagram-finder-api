<?php

namespace App\Services;

use App\Repositories\WordRepositoryInterface;
use App\Services\AnagramAlgorithm\AnagramAlgorithmInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

class AdvancedWordbaseImportService
{
    private const WORDLIST_URL = 'https://www.opus.ee/lemmad2013.txt';
    private const BATCH_SIZE = 500; // Smaller batches for memory efficiency
    private const CACHE_TTL = 3600; // 1 hour cache
    
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
     * Import wordbase with advanced pre-processing and optimization
     */
    public function importWordbase(bool $clearExisting = false): array
    {
        // Increase memory limit for large imports
        ini_set('memory_limit', '512M');
        
        try {
            Log::info('Starting advanced wordbase import', [
                'clear_existing' => $clearExisting,
                'memory_limit' => ini_get('memory_limit')
            ]);

            if ($clearExisting) {
                $this->wordRepository->clearWordbase();
                Cache::flush(); // Clear any cached data
                Log::info('Cleared existing wordbase and cache');
            } elseif (!$this->wordRepository->isWordbaseEmpty()) {
                return [
                    'success' => false,
                    'message' => 'Wordbase already exists. Use force=true to overwrite.',
                    'words_imported' => 0,
                ];
            }

            // Fetch and pre-process wordlist
            $wordData = $this->fetchAndPreprocessWordlist();
            
            // Import in optimized batches
            $importResult = $this->importInBatches($wordData);

            // Create additional indexes for performance
            $this->createOptimizedIndexes();

            // Generate pre-processing statistics
            $stats = $this->generateImportStatistics($importResult);

            Log::info('Advanced wordbase import completed', $stats);

            return [
                'success' => true,
                'message' => "Successfully imported {$importResult['total_imported']} words with advanced optimizations",
                'words_imported' => $importResult['total_imported'],
                'statistics' => $stats,
            ];

        } catch (\Exception $e) {
            Log::error('Advanced wordbase import failed', [
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
     * Fetch and preprocess wordlist with intelligent filtering
     */
    private function fetchAndPreprocessWordlist(): array
    {
        Log::info('Fetching wordlist from source');
        
        // Try to get from cache first
        $cacheKey = 'wordlist_' . md5(self::WORDLIST_URL);
        $cachedData = Cache::get($cacheKey);
        
        if ($cachedData) {
            Log::info('Using cached wordlist data');
            return $cachedData;
        }

        // Fetch from URL with streaming for large files
        $response = Http::timeout(60)
            ->withOptions(['stream' => true])
            ->get(self::WORDLIST_URL);
        
        if (!$response->successful()) {
            throw new \Exception('Failed to fetch wordlist: HTTP ' . $response->status());
        }

        $content = $response->body();
        if (empty($content)) {
            throw new \Exception('Wordlist content is empty');
        }

        // Advanced preprocessing with Unicode validation
        $words = $this->intelligentWordParsing($content);
        
        // Cache the processed data
        Cache::put($cacheKey, $words, self::CACHE_TTL);
        
        return $words;
    }

    /**
     * Intelligent word parsing with Unicode validation and filtering
     */
    private function intelligentWordParsing(string $content): array
    {
        Log::info('Starting intelligent word parsing');
        
        // Ensure content is valid UTF-8
        if (!mb_check_encoding($content, 'UTF-8')) {
            // Try to convert from common encodings
            $encodings = ['UTF-8', 'ISO-8859-1', 'Windows-1252', 'ISO-8859-15'];
            foreach ($encodings as $encoding) {
                $converted = mb_convert_encoding($content, 'UTF-8', $encoding);
                if (mb_check_encoding($converted, 'UTF-8')) {
                    $content = $converted;
                    Log::info("Converted content from {$encoding} to UTF-8");
                    break;
                }
            }
        }

        // Split into lines and process
        $lines = preg_split('/\r\n|\r|\n/', $content);
        $processedWords = [];
        $stats = [
            'total_lines' => count($lines),
            'valid_words' => 0,
            'skipped_empty' => 0,
            'skipped_invalid' => 0,
            'skipped_too_short' => 0,
            'skipped_too_long' => 0,
            'unicode_chars_found' => []
        ];

        foreach ($lines as $line) {
            $word = trim($line);
            
            // Skip empty lines
            if (empty($word)) {
                $stats['skipped_empty']++;
                continue;
            }

            // Validate UTF-8
            if (!mb_check_encoding($word, 'UTF-8')) {
                $stats['skipped_invalid']++;
                continue;
            }

            // Length validation
            $wordLength = mb_strlen($word, 'UTF-8');
            if ($wordLength < 2) {
                $stats['skipped_too_short']++;
                continue;
            }
            if ($wordLength > 50) { // Reasonable maximum
                $stats['skipped_too_long']++;
                continue;
            }

            // Check for Estonian-specific characters
            if (preg_match('/[äöüõšž]/u', $word)) {
                $stats['unicode_chars_found'][] = $word;
            }

            $processedWords[] = $word;
            $stats['valid_words']++;
        }

        // Limit Estonian character examples for logging
        $stats['unicode_chars_found'] = array_slice(array_unique($stats['unicode_chars_found']), 0, 10);
        
        Log::info('Word parsing completed', $stats);
        
        return array_unique($processedWords); // Remove any duplicates
    }

    /**
     * Import words in optimized batches with advanced processing
     */
    private function importInBatches(array $words): array
    {
        Log::info('Starting batch import', ['total_words' => count($words)]);
        
        $batches = array_chunk($words, self::BATCH_SIZE);
        $totalImported = 0;
        $canonicalFormStats = [];
        $lengthDistribution = [];

        DB::beginTransaction();
        
        try {
            foreach ($batches as $batchIndex => $batch) {
                $batchData = [];
                
                foreach ($batch as $word) {
                    try {
                        // Generate canonical form with advanced algorithm
                        $canonicalForm = $this->anagramAlgorithm->generateCanonical($word);
                        $length = mb_strlen($word, 'UTF-8');
                        
                        $batchData[] = [
                            'original_word' => $word,
                            'canonical_form' => $canonicalForm,
                            'length' => $length,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ];

                        // Collect statistics
                        $canonicalFormStats[$canonicalForm] = ($canonicalFormStats[$canonicalForm] ?? 0) + 1;
                        $lengthDistribution[$length] = ($lengthDistribution[$length] ?? 0) + 1;
                        
                    } catch (\Exception $e) {
                        Log::warning('Failed to process word in batch', [
                            'word' => $word,
                            'batch' => $batchIndex,
                            'error' => $e->getMessage()
                        ]);
                    }
                }

                // Insert batch
                if (!empty($batchData)) {
                    DB::table('words')->insert($batchData);
                    $totalImported += count($batchData);
                }

                // Log progress every 10 batches
                if (($batchIndex + 1) % 10 === 0) {
                    Log::info('Batch import progress', [
                        'batches_completed' => $batchIndex + 1,
                        'total_batches' => count($batches),
                        'words_imported' => $totalImported,
                        'memory_usage' => memory_get_usage(true)
                    ]);
                }

                // Clear algorithm cache periodically to manage memory
                if (method_exists($this->anagramAlgorithm, 'clearCache')) {
                    if (($batchIndex + 1) % 50 === 0) {
                        $this->anagramAlgorithm->clearCache();
                    }
                }
            }

            DB::commit();
            
            return [
                'total_imported' => $totalImported,
                'canonical_form_stats' => $canonicalFormStats,
                'length_distribution' => $lengthDistribution,
            ];

        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Create optimized database indexes for performance
     */
    private function createOptimizedIndexes(): void
    {
        Log::info('Creating optimized database indexes');
        
        try {
            // Composite index for common query patterns
            DB::statement('CREATE INDEX IF NOT EXISTS idx_words_canonical_length ON words(canonical_form, length)');
            
            // Index for word length queries (useful for optimization)
            DB::statement('CREATE INDEX IF NOT EXISTS idx_words_length_canonical ON words(length, canonical_form)');
            
            // Partial index for common word lengths (2-10 characters)
            DB::statement('CREATE INDEX IF NOT EXISTS idx_words_common_lengths ON words(canonical_form) WHERE length BETWEEN 2 AND 10');
            
            Log::info('Database indexes created successfully');
            
        } catch (\Exception $e) {
            Log::warning('Failed to create some database indexes', [
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Generate comprehensive import statistics
     */
    private function generateImportStatistics(array $importResult): array
    {
        $stats = [
            'total_words_imported' => $importResult['total_imported'],
            'unique_canonical_forms' => count($importResult['canonical_form_stats']),
            'average_anagram_group_size' => 0,
            'largest_anagram_group' => 0,
            'word_length_distribution' => $importResult['length_distribution'],
            'memory_usage' => [
                'current' => memory_get_usage(true),
                'peak' => memory_get_peak_usage(true)
            ]
        ];

        // Calculate anagram statistics
        if (!empty($importResult['canonical_form_stats'])) {
            $anagramCounts = array_values($importResult['canonical_form_stats']);
            $stats['average_anagram_group_size'] = array_sum($anagramCounts) / count($anagramCounts);
            $stats['largest_anagram_group'] = max($anagramCounts);
            
            // Find examples of large anagram groups
            $largeGroups = array_filter($importResult['canonical_form_stats'], function($count) {
                return $count > 5;
            });
            $stats['large_anagram_groups_count'] = count($largeGroups);
        }

        return $stats;
    }

    /**
     * Get advanced import status with performance metrics
     */
    public function getAdvancedImportStatus(): array
    {
        $basicStatus = [
            'wordbase_exists' => !$this->wordRepository->isWordbaseEmpty(),
            'word_count' => $this->wordRepository->getWordCount(),
            'source_url' => self::WORDLIST_URL,
        ];

        if ($basicStatus['wordbase_exists']) {
            // Get database statistics
            $dbStats = DB::select('
                SELECT 
                    COUNT(*) as total_words,
                    COUNT(DISTINCT canonical_form) as unique_canonical_forms,
                    MIN(length) as min_word_length,
                    MAX(length) as max_word_length,
                    AVG(length) as avg_word_length
                FROM words
            ')[0];

            $basicStatus['database_statistics'] = (array) $dbStats;

            // Get index information
            $indexes = DB::select("SELECT name FROM sqlite_master WHERE type='index' AND tbl_name='words'");
            $basicStatus['database_indexes'] = array_column($indexes, 'name');
        }

        return $basicStatus;
    }
}
