<?php

namespace App\Console\Commands;

use App\Services\AnagramService;
use App\Services\WordbaseImportService;
use App\Repositories\WordRepositoryInterface;
use App\Services\AnagramAlgorithm\UnicodeOptimizedAnagramAlgorithm;
use Illuminate\Console\Command;

class TestUnicodeAnagrams extends Command
{
    protected $signature = 'test:unicode';
    protected $description = 'Test Unicode anagram functionality with Estonian words';

    public function handle()
    {
        $this->info('Testing Unicode Anagram Functionality');
        
        // Test algorithm directly
        $algorithm = new UnicodeOptimizedAnagramAlgorithm();
        
        // Test Estonian words with special characters
        $testWords = [
            'sõna',     // Estonian word meaning "word"
            'näos',     // Estonian word 
            'öö',       // Estonian word meaning "night"
            'üle',      // Estonian word meaning "over"
            'ärm',      // Estonian word
            'listen',   // English word for comparison
            'silent',   // English anagram of listen
        ];

        $this->info('Testing canonical form generation:');
        foreach ($testWords as $word) {
            try {
                $canonical = $algorithm->generateCanonical($word);
                $length = mb_strlen($word, 'UTF-8');
                $hasUnicode = preg_match('/[^\x00-\x7F]/', $word) === 1;
                $isEstonian = preg_match('/[äöüõšž]/u', $word) === 1;
                
                $this->line("Word: {$word}");
                $this->line("  Canonical: {$canonical}");
                $this->line("  Length: {$length}");
                $this->line("  Has Unicode: " . ($hasUnicode ? 'Yes' : 'No'));
                $this->line("  Estonian chars: " . ($isEstonian ? 'Yes' : 'No'));
                $this->line('');
                
            } catch (\Exception $e) {
                $this->error("Error processing '{$word}': " . $e->getMessage());
            }
        }

        // Test that listen and silent have the same canonical form
        try {
            $listen = $algorithm->generateCanonical('listen');
            $silent = $algorithm->generateCanonical('silent');
            
            if ($listen === $silent) {
                $this->info("✅ 'listen' and 'silent' have the same canonical form: {$listen}");
            } else {
                $this->error("❌ 'listen' ({$listen}) and 'silent' ({$silent}) should have the same canonical form");
            }
        } catch (\Exception $e) {
            $this->error("Error testing listen/silent: " . $e->getMessage());
        }

        // Test cache functionality
        $this->info('Testing cache functionality:');
        $startTime = microtime(true);
        for ($i = 0; $i < 1000; $i++) {
            $algorithm->generateCanonical('listen');
        }
        $endTime = microtime(true);
        $this->info("Generated 1000 canonical forms in " . round(($endTime - $startTime) * 1000, 2) . "ms");
        
        $stats = $algorithm->getCacheStats();
        $this->info("Cache stats: " . json_encode($stats, JSON_PRETTY_PRINT));
        
        return 0;
    }
}
