<?php

echo "Starting test data insertion...\n";

try {
    require_once __DIR__ . '/vendor/autoload.php';
    echo "Autoloader included\n";

    $app = require_once __DIR__ . '/bootstrap/app.php';
    echo "App bootstrapped\n";
    
    $app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();
    echo "Kernel bootstrapped\n";
} catch (Exception $e) {
    echo "Bootstrap error: " . $e->getMessage() . "\n";
    exit(1);
}

use App\Models\Word;
use App\Services\AnagramAlgorithm\UnicodeOptimizedAnagramAlgorithm;

echo "Inserting test words for anagram testing...\n";

$algorithm = new UnicodeOptimizedAnagramAlgorithm();

// Clear existing data
Word::truncate();

$testWords = [
    'listen', 'silent', 'enlist',  // English anagram group
    'sõna', 'ansõ',                // Estonian word + potential anagram  
    'öö',                          // Estonian word
    'näos', 'nosä',               // Estonian words
];

foreach ($testWords as $word) {
    try {
        $canonical = $algorithm->generateCanonical($word);
        $length = mb_strlen($word, 'UTF-8');
        
        Word::create([
            'original_word' => $word,
            'canonical_form' => $canonical,
            'length' => $length
        ]);
        
        echo "Inserted: {$word} -> {$canonical} (length: {$length})\n";
    } catch (Exception $e) {
        echo "Error inserting '{$word}': " . $e->getMessage() . "\n";
    }
}

echo "\nWords inserted successfully!\n";
echo "Total words in database: " . Word::count() . "\n";

// Test anagram finding
echo "\nTesting anagram search:\n";
$testSearches = ['listen', 'sõna', 'öö'];

foreach ($testSearches as $searchWord) {
    $canonical = $algorithm->generateCanonical($searchWord);
    $anagrams = Word::where('canonical_form', $canonical)
                   ->where('original_word', '!=', $searchWord)
                   ->pluck('original_word')
                   ->toArray();
    
    echo "Anagrams of '{$searchWord}': " . implode(', ', $anagrams) . "\n";
}
