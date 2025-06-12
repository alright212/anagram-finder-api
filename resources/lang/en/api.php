<?php

return [
    // General API messages
    'welcome' => 'Welcome to Anagram Finder API',
    'success' => 'Operation completed successfully',
    'error' => 'An error occurred',
    'not_found' => 'Resource not found',
    'invalid_request' => 'Invalid request',
    'service_unavailable' => 'Service temporarily unavailable',

    // Anagram-specific messages
    'anagrams' => [
        'found' => 'Found :count anagram(s) for ":word"',
        'none_found' => 'No anagrams found for ":word"',
        'search_completed' => 'Anagram search completed',
        'invalid_word' => 'Invalid word provided',
        'word_too_long' => 'Word too long. Maximum length is :max characters',
        'word_too_short' => 'Word too short. Minimum length is :min characters',
        'empty_word' => 'Word parameter cannot be empty',
        'processing_error' => 'Error processing word ":word"',
        'unicode_support' => 'Full Unicode support enabled',
        'estonian_characters' => 'Estonian characters detected: :chars',
    ],

    // Wordbase messages
    'wordbase' => [
        'import_started' => 'Wordbase import started',
        'import_completed' => 'Wordbase import completed successfully',
        'import_failed' => 'Wordbase import failed',
        'already_exists' => 'Wordbase already exists. Use force=true to overwrite',
        'not_ready' => 'Wordbase not available. Please import wordbase first',
        'clearing' => 'Clearing existing wordbase',
        'cleared' => 'Wordbase cleared successfully',
        'empty' => 'Wordbase is empty',
        'status_check' => 'Checking wordbase status',
        'words_imported' => ':count words imported successfully',
        'source_unreachable' => 'Unable to reach word source',
        'invalid_source' => 'Invalid word source data',
        'processing_words' => 'Processing words',
        'optimizing_database' => 'Optimizing database indexes',
        'statistics_generated' => 'Import statistics generated',
    ],

    // Advanced wordbase messages
    'advanced_wordbase' => [
        'unicode_processing' => 'Advanced Unicode processing enabled',
        'estonian_optimization' => 'Estonian language optimization active',
        'batch_processing' => 'Processing batch :current of :total',
        'memory_optimization' => 'Memory optimization in progress',
        'cache_management' => 'Cache management active',
        'performance_tuning' => 'Performance tuning applied',
        'unicode_words_found' => 'Found :count words with Unicode characters',
        'canonical_forms_generated' => 'Generated :count unique canonical forms',
        'index_creation' => 'Creating optimized database indexes',
        'algorithm_cache_cleared' => 'Algorithm cache cleared for memory management',
    ],

    // Validation messages
    'validation' => [
        'required' => 'The :attribute field is required',
        'boolean' => 'The :attribute field must be true or false',
        'string' => 'The :attribute field must be a string',
        'max_length' => 'The :attribute field must not exceed :max characters',
        'min_length' => 'The :attribute field must be at least :min characters',
        'invalid_encoding' => 'The :attribute field contains invalid UTF-8 encoding',
    ],

    // Error codes
    'error_codes' => [
        'INVALID_WORD' => 'Invalid word parameter',
        'WORD_TOO_LONG' => 'Word exceeds maximum length',
        'WORD_TOO_SHORT' => 'Word below minimum length',
        'WORDBASE_NOT_READY' => 'Wordbase is not ready',
        'WORDBASE_EXISTS' => 'Wordbase already exists',
        'IMPORT_FAILED' => 'Import operation failed',
        'INVALID_INPUT' => 'Invalid input provided',
        'PROCESSING_ERROR' => 'Processing error occurred',
        'UNICODE_ERROR' => 'Unicode processing error',
        'DATABASE_ERROR' => 'Database operation error',
        'MEMORY_ERROR' => 'Memory limit exceeded',
        'NETWORK_ERROR' => 'Network connection error',
    ],

    // Statistics and metadata
    'stats' => [
        'total_words' => 'Total words',
        'unique_canonical_forms' => 'Unique canonical forms',
        'average_word_length' => 'Average word length',
        'min_word_length' => 'Minimum word length',
        'max_word_length' => 'Maximum word length',
        'unicode_words' => 'Words with Unicode characters',
        'ascii_words' => 'ASCII-only words',
        'estonian_words' => 'Words with Estonian characters',
        'algorithm_type' => 'Algorithm type',
        'cache_enabled' => 'Caching enabled',
        'processing_time' => 'Processing time',
        'memory_usage' => 'Memory usage',
        'database_size' => 'Database size',
        'last_updated' => 'Last updated',
        'wordbase_ready' => 'Wordbase ready',
        'optimization_level' => 'Optimization level',
    ],

    // Algorithm messages
    'algorithm' => [
        'sorting' => 'Character sorting algorithm',
        'unicode_optimized' => 'Unicode-optimized algorithm',
        'frequency_map' => 'Character frequency mapping',
        'cache_hit' => 'Cache hit for canonical form',
        'cache_miss' => 'Cache miss, generating canonical form',
        'normalization_applied' => 'Unicode normalization applied',
        'estonian_mapping' => 'Estonian character mapping applied',
        'grapheme_processing' => 'Grapheme cluster processing',
        'collation_sorting' => 'Unicode collation sorting',
    ],

    // Time and performance
    'performance' => [
        'search_time' => 'Search completed in :time ms',
        'import_time' => 'Import completed in :time seconds',
        'cache_performance' => 'Cache hit ratio: :ratio%',
        'memory_peak' => 'Peak memory usage: :memory',
        'batch_progress' => 'Batch :current/:total processed',
        'optimization_applied' => 'Performance optimizations applied',
        'index_created' => 'Database index created: :index',
    ],
];
