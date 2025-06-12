<?php

echo "Starting test script...\n";

require_once __DIR__ . '/vendor/autoload.php';

echo "Autoload complete...\n";

use App\Services\AnagramAlgorithm\UnicodeOptimizedAnagramAlgorithm;

echo "Class imported...\n";

echo "Testing Unicode Anagram Functionality\n";
echo "=====================================\n\n";

try {
    $algorithm = new UnicodeOptimizedAnagramAlgorithm();
    echo "Algorithm instance created...\n";
} catch (Exception $e) {
    echo "Error creating algorithm: " . $e->getMessage() . "\n";
    exit(1);
}

// Test Estonian words with special characters
$testWords = [
    'sõna',     // Estonian word meaning "word"
    'näos',     // Estonian word 
    'öö',       // Estonian word meaning "night"
    'üle',      // Estonian word meaning "over"
    'listen',   // English word for comparison
    'silent',   // English anagram of listen
];

echo "Testing canonical form generation:\n";
foreach ($testWords as $word) {
    try {
        $canonical = $algorithm->generateCanonical($word);
        $length = mb_strlen($word, 'UTF-8');
        $hasUnicode = preg_match('/[^\x00-\x7F]/', $word) === 1;
        $isEstonian = preg_match('/[äöüõšž]/u', $word) === 1;
        
        echo "Word: {$word}\n";
        echo "  Canonical: {$canonical}\n";
        echo "  Length: {$length}\n";
        echo "  Has Unicode: " . ($hasUnicode ? 'Yes' : 'No') . "\n";
        echo "  Estonian chars: " . ($isEstonian ? 'Yes' : 'No') . "\n";
        echo "\n";
        
    } catch (Exception $e) {
        echo "Error processing '{$word}': " . $e->getMessage() . "\n";
    }
}

// Test that listen and silent have the same canonical form
try {
    $listen = $algorithm->generateCanonical('listen');
    $silent = $algorithm->generateCanonical('silent');
    
    if ($listen === $silent) {
        echo "✅ 'listen' and 'silent' have the same canonical form: {$listen}\n";
    } else {
        echo "❌ 'listen' ({$listen}) and 'silent' ({$silent}) should have the same canonical form\n";
    }
} catch (Exception $e) {
    echo "Error testing listen/silent: " . $e->getMessage() . "\n";
}

echo "\nTest completed!\n";
