<?php
require 'vendor/autoload.php';

// Simple script to find top anagrams via direct database query
try {
    $pdo = new PDO('sqlite:database/database.sqlite');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "Finding Estonian words with the most anagrams...\n\n";
    
    // Query to find canonical forms with the most anagrams
    $sql = "
        SELECT 
            canonical_form,
            COUNT(*) as anagram_count
        FROM words 
        GROUP BY canonical_form 
        HAVING anagram_count > 1 
        ORDER BY anagram_count DESC 
        LIMIT 15
    ";
    
    $stmt = $pdo->query($sql);
    $topGroups = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($topGroups as $group) {
        echo "🏆 " . $group['anagram_count'] . " anagrams with canonical form: " . $group['canonical_form'] . "\n";
        
        // Get all words for this canonical form
        $wordsSql = "SELECT original_word FROM words WHERE canonical_form = ? ORDER BY original_word";
        $wordsStmt = $pdo->prepare($wordsSql);
        $wordsStmt->execute([$group['canonical_form']]);
        $words = $wordsStmt->fetchAll(PDO::FETCH_COLUMN);
        
        echo "   Words: " . implode(', ', $words) . "\n\n";
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
