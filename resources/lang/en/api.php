<?php

return [
    // General API messages
    'welcome' => 'Welcome to Anagram Finder API',
    'success' => 'Operation completed successfully',
    'error' => 'An error occurred',
    'not_found' => 'Resource not found',
    'invalid_request' => 'Invalid request',
    'service_unavailable' => 'Service temporarily unavailable',

    // Common UI elements
    'common' => [
        'search' => 'Search',
        'import' => 'Import',
        'about' => 'About',
        'home' => 'Home',
        'loading' => 'Loading...',
        'error' => 'Error',
        'success' => 'Success',
        'cancel' => 'Cancel',
        'save' => 'Save',
        'delete' => 'Delete',
        'edit' => 'Edit',
        'close' => 'Close',
        'language' => 'Language',
    ],

    // Navigation elements
    'navigation' => [
        'title' => 'Estonian Anagram Finder',
        'subtitle' => 'Find word anagrams quickly and easily',
    ],

    // Search interface
    'search' => [
        'title' => 'Anagram Search',
        'description' => 'Enter an Estonian word to find its anagrams',
        'placeholder' => 'Enter a word to find anagrams...',
        'searchButton' => 'Search Anagrams',
        'noResults' => 'No anagrams found',
        'recentSearches' => 'Recent Searches',
        'results' => [
            'title' => 'Found anagrams:',
            'count' => 'Total: {{count}} anagrams',
            'executionTime' => 'Search time: {{time}}ms',
            'algorithm' => 'Algorithm: {{algorithm}}',
        ],
        'tips' => [
            'title' => '💡 Search Tips',
            'items' => [
                'estonianWords' => 'Use Estonian words for best results',
                'minimumLength' => 'Words must be at least 2 characters long',
                'clickResults' => 'Click on any anagram result to search for its anagrams',
                'useHistory' => 'Use your recent searches for quick access',
            ],
        ],
    ],

    // Error messages
    'errors' => [
        'networkError' => 'Network connection error',
        'serverError' => 'Server error',
        'invalidInput' => 'Invalid input',
        'wordNotFound' => 'Word not found',
        'importFailed' => 'Import failed',
    ],

    // Wordbase management
    'wordbase' => [
        'title' => 'Wordbase Import',
        'status' => 'Wordbase Status',
        'totalWords' => 'Total words: {{count}}',
        'lastImport' => 'Last import: {{date}}',
        'statusLabels' => [
            'total_words' => 'Total Words',
            'languages' => 'Languages',
            'last_updated' => 'Last Updated',
        ],
        'import' => [
            'title' => 'Import Wordbase',
            'description' => 'Import new words into the wordbase for anagram generation.',
            'instructions' => [
                'title' => 'Import Instructions',
                'plain_text' => 'Plain Text Format: Enter one word per line',
                'json_format' => 'JSON Format: Provide an array of strings like ["word1", "word2"]',
                'language_selection' => 'Language Selection: Choose the appropriate language for the words',
                'duplicates' => 'Duplicates: Duplicate words will be automatically skipped',
                'processing_time' => 'Processing Time: Large imports may take several seconds',
            ],
        ],
        'importForm' => [
            'title' => 'Import Words',
            'content' => 'Words (one per line)',
            'format' => 'Format',
            'language' => 'Language',
            'importButton' => 'Import Words',
            'placeholder' => 'Enter words to import (one per line for text format, or JSON array for JSON format)',
            'failed' => 'Import failed',
            'validation' => [
                'wordsRequired' => 'Please enter some words',
            ],
        ],
        'formats' => [
            'plaintext' => 'Plain text',
            'json' => 'JSON',
        ],
        'languages' => [
            'et' => 'Estonian',
            'en' => 'English',
            'de' => 'German',
            'fr' => 'French',
        ],
        // Legacy API messages for backward compatibility
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

    // About page
    'about' => [
        'title' => 'About Anagram Finder',
        'description' => 'This application allows you to find anagrams of Estonian words using advanced algorithms.',
        'features' => [
            'title' => 'Features',
            'items' => [
                'fastSearch' => 'Fast anagram search',
                'fastSearchDescription' => 'Optimized algorithms for instant anagram detection',
                'multilingualSupport' => 'Multilingual support',
                'multilingualSupportDescription' => 'Support for Estonian, English, German, and French',
                'customDatabase' => 'Customizable word database',
                'customDatabaseDescription' => 'Import your own word lists and customize the database',
                'modernInterface' => 'Modern user interface',
                'modernInterfaceDescription' => 'Built with React 18, TypeScript, and Chakra UI',
                'realTimeStats' => 'Real-time statistics',
                'realTimeStatsDescription' => 'View search performance and word database statistics',
            ],
        ],
        'algorithm' => [
            'title' => 'Algorithm',
            'description' => 'We use optimized algorithms that ensure fast and accurate anagram detection.',
            'types' => [
                'characterFrequency' => [
                    'name' => 'Character Frequency Analysis',
                    'description' => 'Uses character frequency counting for efficient anagram detection',
                    'complexity' => 'O(n + m)',
                ],
                'sortingBased' => [
                    'name' => 'Sorting-based Comparison',
                    'description' => 'Sorts characters to find anagrams through string comparison',
                    'complexity' => 'O(n log n)',
                ],
                'hashBased' => [
                    'name' => 'Hash-based Lookup',
                    'description' => 'Pre-computed hash tables for ultra-fast anagram retrieval',
                    'complexity' => 'O(1) lookup',
                ],
            ],
        ],
        'techStack' => [
            'frontend' => [
                'title' => 'Frontend Technologies',
                'items' => [
                    'reactTypeScript' => 'React 18 with TypeScript',
                    'chakraUI' => 'Chakra UI for modern design',
                    'reactRouter' => 'React Router for navigation',
                    'reactHookForm' => 'React Hook Form for forms',
                    'i18next' => 'i18next for internationalization',
                    'axios' => 'Axios for API communication',
                    'zod' => 'Zod for validation',
                ],
            ],
            'backend' => [
                'title' => 'Backend Technologies',
                'items' => [
                    'laravel' => 'Laravel 11 PHP Framework',
                    'restfulAPI' => 'RESTful API with Swagger docs',
                    'sqlite' => 'SQLite database',
                    'multiLanguage' => 'Multi-language support',
                    'algorithms' => 'Optimized anagram algorithms',
                    'errorHandling' => 'Comprehensive error handling',
                    'monitoring' => 'Performance monitoring',
                ],
            ],
        ],
        'performance' => [
            'title' => 'Performance Highlights',
            'metrics' => [
                'searchTime' => [
                    'value' => '<100ms',
                    'label' => 'Average search time',
                ],
                'wordsSupported' => [
                    'value' => '500K+',
                    'label' => 'Words supported',
                ],
                'languagesSupported' => [
                    'value' => '4',
                    'label' => 'Languages supported',
                ],
                'uptime' => [
                    'value' => '99.9%',
                    'label' => 'Uptime reliability',
                ],
            ],
        ],
        'gettingStarted' => [
            'title' => 'Getting Started',
            'steps' => [
                'importDatabase' => [
                    'title' => 'Import Word Database',
                    'description' => 'Start by importing a word list through the Import page. You can use the default Estonian wordlist or upload your own.',
                ],
                'searchAnagrams' => [
                    'title' => 'Search for Anagrams',
                    'description' => 'Enter any word in the search page to find all possible anagrams instantly using our optimized algorithms.',
                ],
                'exploreAnalyze' => [
                    'title' => 'Explore and Analyze',
                    'description' => 'Use the statistics page to analyze your wordbase and view search history and discover word patterns.',
                ],
            ],
        ],
        'apiDocumentation' => [
            'title' => 'API Documentation',
            'description' => 'This application uses a Laravel-based REST API with comprehensive documentation available through Swagger/OpenAPI.',
            'linkLabel' => 'API Documentation:',
            'viewDocs' => 'View API Docs',
        ],
    ],

    // Home page UI elements
    'home' => [
        'statistics' => [
            'title' => '🏆 Production Statistics',
            'estonianWords' => 'Estonian Words',
            'avgResponse' => 'Avg Response',
            'unicodeSupport' => 'Unicode Support',
            'lookupTime' => 'Lookup Time',
            'totalWords' => 'Total Words',
            'inDatabase' => 'in database',
            'uniqueAnagrams' => 'Unique Anagrams',
            'combinations' => 'combinations',
            'mostAnagrams' => 'Most Anagrams',
            'for' => 'for the word',
            'avgSearchTime' => 'Avg Search Time',
            'perSearch' => 'per search',
        ],
        'features' => [
            'fastSearch' => 'Optimized algorithms for instant anagram detection',
            'importDatabase' => 'Import your own word lists to customize the search database',
            'modernInterface' => 'Modern, responsive interface built with React and Chakra UI',
        ],
        'readyToSearch' => 'Ready to Search!',
        'databaseLoaded' => 'Your word database is loaded with {{count}} words. Start finding anagrams now!',
        'startSearching' => 'Start Searching',
    ],

    // Footer
    'footer' => [
        'copyright' => '2025 Estonian Anagram Finder. Made with ❤️ for Estonian language.',
    ],

    // Anagram-specific messages (for API responses)
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
