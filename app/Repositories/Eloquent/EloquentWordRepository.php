<?php

namespace App\Repositories\Eloquent;

use App\Models\Word;
use App\Repositories\WordRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

class EloquentWordRepository implements WordRepositoryInterface
{
    private const CACHE_TTL = 300; // 5 minutes cache for frequent queries

    public function addWord(string $originalWord, string $canonicalForm, int $length): void
    {
        Word::create([
            'original_word' => $originalWord,
            'canonical_form' => $canonicalForm,
            'length' => $length,
        ]);
    }

    public function findAnagrams(string $canonicalForm, ?string $wordToExclude = null): array
    {
        // Use caching for frequently searched canonical forms
        $cacheKey = 'anagrams_' . md5($canonicalForm . '_' . ($wordToExclude ?? ''));
        
        return Cache::remember($cacheKey, self::CACHE_TTL, function () use ($canonicalForm, $wordToExclude) {
            $query = Word::where('canonical_form', $canonicalForm);
            
            if ($wordToExclude) {
                // Use case-insensitive comparison for Unicode safety
                $query->whereRaw('LOWER(original_word) != LOWER(?)', [mb_strtolower($wordToExclude, 'UTF-8')]);
            }
            
            return $query->orderBy('original_word')
                        ->pluck('original_word')
                        ->toArray();
        });
    }

    public function storeWordbase(array $wordsData): bool
    {
        try {
            // Use chunking for very large datasets to avoid memory issues
            $chunks = array_chunk($wordsData, 1000);
            
            DB::transaction(function () use ($chunks) {
                foreach ($chunks as $chunk) {
                    DB::table('words')->insert($chunk);
                }
            });
            
            // Clear cache after import
            $this->clearAnagramCache();
            
            return true;
        } catch (\Exception $e) {
            Log::error('Failed to store wordbase: ' . $e->getMessage());
            return false;
        }
    }

    public function clearWordbase(): void
    {
        Word::truncate();
        $this->clearAnagramCache();
    }

    public function isWordbaseEmpty(): bool
    {
        return Word::count() === 0;
    }

    public function getWordCount(): int
    {
        return Cache::remember('word_count', self::CACHE_TTL, function () {
            return Word::count();
        });
    }

    public function getStatistics(): array
    {
        return Cache::remember('wordbase_statistics', self::CACHE_TTL, function () {
            $stats = DB::table('words')
                ->selectRaw('
                    COUNT(*) as total_words,
                    COUNT(DISTINCT canonical_form) as unique_canonical_forms,
                    MIN(length) as min_length,
                    MAX(length) as max_length,
                    AVG(length) as avg_length
                ')
                ->first();

            // Get length distribution
            $lengthDistribution = DB::table('words')
                ->select('length', DB::raw('COUNT(*) as count'))
                ->groupBy('length')
                ->orderBy('length')
                ->get()
                ->pluck('count', 'length')
                ->toArray();

            return [
                'total_words' => $stats->total_words,
                'unique_canonical_forms' => $stats->unique_canonical_forms,
                'min_length' => $stats->min_length,
                'max_length' => $stats->max_length,
                'avg_length' => round($stats->avg_length, 2),
                'length_distribution' => $lengthDistribution,
            ];
        });
    }

    /**
     * Clear anagram-related cache
     */
    private function clearAnagramCache(): void
    {
        // Clear cache tags if using tagged cache
        if (method_exists(Cache::getStore(), 'tags')) {
            Cache::tags(['anagrams'])->flush();
        } else {
            // Fallback: clear specific cache keys (less efficient)
            Cache::forget('word_count');
            Cache::forget('wordbase_statistics');
        }
    }

    /**
     * Get words with Unicode characters (Estonian specific)
     */
    public function getUnicodeWords(int $limit = 100): array
    {
        // SQLite doesn't support REGEXP by default, so we'll use LIKE patterns
        // or fetch all and filter in PHP for more accurate Unicode detection
        return Word::where(function($query) {
                    $query->where('original_word', 'LIKE', '%ä%')
                          ->orWhere('original_word', 'LIKE', '%ö%')
                          ->orWhere('original_word', 'LIKE', '%ü%')
                          ->orWhere('original_word', 'LIKE', '%õ%')
                          ->orWhere('original_word', 'LIKE', '%š%')
                          ->orWhere('original_word', 'LIKE', '%ž%');
                })
                ->limit($limit)
                ->orderBy('original_word')
                ->pluck('original_word')
                ->toArray();
    }
}
