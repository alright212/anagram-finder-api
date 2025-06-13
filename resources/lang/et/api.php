<?php

return [
    // General API messages
    'welcome' => 'Tere tulemast Anagrammi Otsija API-sse',
    'success' => 'Toiming lõpetatud edukalt',
    'error' => 'Ilmnes viga',
    'not_found' => 'Ressurssi ei leitud',
    'invalid_request' => 'Vigane päring',
    'service_unavailable' => 'Teenus ajutiselt kättesaamatu',

    // Common UI elements
    'common' => [
        'search' => 'Otsing',
        'import' => 'Impordi',
        'about' => 'Teave',
        'home' => 'Avaleht',
        'loading' => 'Laadimine...',
        'error' => 'Viga',
        'success' => 'Õnnestus',
        'cancel' => 'Loobu',
        'save' => 'Salvesta',
        'delete' => 'Kustuta',
        'edit' => 'Muuda',
        'close' => 'Sulge',
    ],

    // Navigation elements
    'navigation' => [
        'title' => 'Eesti anagrammide otsija',
        'subtitle' => 'Leia sõnade anagramme kiirelt ja lihtsalt',
    ],

    // Search interface
    'search' => [
        'title' => 'Anagrammide otsing',
        'description' => 'Sisesta eesti sõna, et leida selle anagramme',
        'placeholder' => 'Sisesta sõna anagrammide leidmiseks...',
        'searchButton' => 'Otsi Anagramme',
        'noResults' => 'Anagramme ei leitud',
        'recentSearches' => 'Hiljutised otsingud',
        'results' => [
            'title' => 'Leitud anagrammid:',
            'count' => 'Kokku: {{count}} anagrammi',
            'executionTime' => 'Otsinguaeg: {{time}}ms',
            'algorithm' => 'Algoritm: {{algorithm}}',
        ],
        'tips' => [
            'title' => '💡 Otsinguvihjed',
            'items' => [
                'estonianWords' => 'Kasuta eesti sõnu parimate tulemuste saamiseks',
                'minimumLength' => 'Sõnad peavad olema vähemalt 2 tähemärki pikad',
                'clickResults' => 'Klõpsa mis tahes anagrammi tulemusel, et otsida selle anagramme',
                'useHistory' => 'Kasuta oma hiljutiseid otsinguid kiireks juurdepääsuks',
            ],
        ],
    ],

    // Error messages
    'errors' => [
        'networkError' => 'Võrguühenduse viga',
        'serverError' => 'Serveri viga',
        'invalidInput' => 'Vigane sisend',
        'wordNotFound' => 'Sõna ei leitud',
        'importFailed' => 'Import ebaõnnestus',
    ],

    // Wordbase management
    'wordbase' => [
        'title' => 'Sõnabaasi import',
        'status' => 'Sõnabaasi olek',
        'totalWords' => 'Kokku sõnu: {{count}}',
        'lastImport' => 'Viimane import: {{date}}',
        'statusLabels' => [
            'total_words' => 'Kokku sõnu',
            'languages' => 'Keeled',
            'last_updated' => 'Viimati uuendatud',
        ],
        'import' => [
            'title' => 'Sõnabaasi import',
            'description' => 'Impordi uusi sõnu sõnabaasi anagrammide genereerimiseks.',
            'instructions' => [
                'title' => 'Importimise juhised',
                'plain_text' => 'Tavaline tekst: Sisesta üks sõna rea kohta',
                'json_format' => 'JSON formaat: Anna stringide massiiv nagu ["sõna1", "sõna2"]',
                'language_selection' => 'Keele valik: Vali sõnadele sobiv keel',
                'duplicates' => 'Duplikaadid: Dubleeritud sõnad jäetakse automaatselt vahele',
                'processing_time' => 'Töötlemise aeg: Suurte importide puhul võib kuluda mitu sekundit',
            ],
        ],
        'importForm' => [
            'title' => 'Impordi sõnad',
            'content' => 'Sõnad (iga sõna uuel real)',
            'format' => 'Formaat',
            'language' => 'Keel',
            'importButton' => 'Impordi sõnad',
            'placeholder' => 'Sisesta impordiks mõeldud sõnad (üks sõna rea kohta tekstiformaadi puhul või JSON massiiv JSON formaadi puhul)',
            'failed' => 'Import ebaõnnestus',
        ],
        'formats' => [
            'plaintext' => 'Tavaline tekst',
            'json' => 'JSON',
        ],
        'languages' => [
            'et' => 'Eesti keel',
            'en' => 'Inglise keel',
            'de' => 'Saksa keel',
            'fr' => 'Prantsuse keel',
        ],
        // Legacy API messages for backward compatibility
        'import_started' => 'Sõnabaasi import alustatud',
        'import_completed' => 'Sõnabaasi import edukalt lõpetatud',
        'import_failed' => 'Sõnabaasi import ebaõnnestus',
        'already_exists' => 'Sõnabaas on juba olemas. Kasuta force=true ülekirjutamiseks',
        'not_ready' => 'Sõnabaas pole saadaval. Palun impordi kõigepealt sõnabaas',
        'clearing' => 'Olemasoleva sõnabaasi kustutamine',
        'cleared' => 'Sõnabaas edukalt kustutatud',
        'empty' => 'Sõnabaas on tühi',
        'status_check' => 'Sõnabaasi staatuse kontroll',
        'words_imported' => ':count sõna edukalt imporditud',
        'source_unreachable' => 'Sõnaallikas kättesaamatu',
        'invalid_source' => 'Vigased sõnaallika andmed',
        'processing_words' => 'Sõnade töötlemine',
        'optimizing_database' => 'Andmebaasi indeksite optimeerimine',
        'statistics_generated' => 'Importimise statistika genereeritud',
    ],

    // About page
    'about' => [
        'title' => 'Anagrammide otsija kohta',
        'description' => 'See rakendus võimaldab teil leida eesti sõnade anagramme kasutades täiustatud algoritme.',
        'features' => [
            'title' => 'Omadused',
            'items' => [
                'fastSearch' => 'Kiire anagrammide otsing',
                'fastSearchDescription' => 'Optimeeritud algoritmid hetkeliseks anagrammide tuvastamiseks',
                'multilingualSupport' => 'Mitmekeelne tugi',
                'multilingualSupportDescription' => 'Tugi eesti, inglise, saksa ja prantsuse keelele',
                'customDatabase' => 'Kohandatav sõnabaas',
                'customDatabaseDescription' => 'Impordi oma sõnaloendeid ja kohanda andmebaasi',
                'modernInterface' => 'Moodne kasutajaliides',
                'modernInterfaceDescription' => 'Ehitatud React 18, TypeScripti ja Chakra UI abil',
                'realTimeStats' => 'Reaalajas statistika',
                'realTimeStatsDescription' => 'Vaata otsingu jõudlust ja sõnabaasi statistikat',
            ],
        ],
        'algorithm' => [
            'title' => 'Algoritm',
            'description' => 'Kasutame optimeeritud algoritme, mis tagavad kiire ja täpse anagrammide leidmise.',
            'types' => [
                'characterFrequency' => [
                    'name' => 'Tähemärkide sageduse analüüs',
                    'description' => 'Kasutab tähemärkide sageduse lugemist tõhusaks anagrammide tuvastamiseks',
                    'complexity' => 'O(n + m)',
                ],
                'sortingBased' => [
                    'name' => 'Sorteerimispõhine võrdlus',
                    'description' => 'Sorteerib tähemärke anagrammide leidmiseks stringi võrdluse kaudu',
                    'complexity' => 'O(n log n)',
                ],
                'hashBased' => [
                    'name' => 'Räsi-põhine otsing',
                    'description' => 'Eelarvutatud räsi tabelid ülikiireks anagrammide leidmiseks',
                    'complexity' => 'O(1) otsing',
                ],
            ],
        ],
        'techStack' => [
            'frontend' => [
                'title' => 'Frontend tehnoloogiad',
                'items' => [
                    'reactTypeScript' => 'React 18 koos TypeScriptiga',
                    'chakraUI' => 'Chakra UI moodsaks disainiks',
                    'reactRouter' => 'React Router navigeerimiseks',
                    'reactHookForm' => 'React Hook Form vormide jaoks',
                    'i18next' => 'i18next rahvusvahelistumiseks',
                    'zod' => 'Zod valideerimiseks',
                    'axios' => 'Axios API suhtluseks',
                ],
            ],
            'backend' => [
                'title' => 'Backend tehnoloogiad',
                'items' => [
                    'laravel' => 'Laravel 11 PHP raamistik',
                    'restfulAPI' => 'RESTful API Swagger dokumentatsiooniga',
                    'sqlite' => 'SQLite andmebaas',
                    'multiLanguage' => 'Mitmekeelne tugi',
                    'algorithms' => 'Optimeeritud anagrammi algoritmid',
                    'errorHandling' => 'Põhjalik vigade käsitlemine',
                    'monitoring' => 'Jõudluse monitooring',
                ],
            ],
        ],
        'performance' => [
            'title' => 'Jõudluse esiletõstmised',
            'metrics' => [
                'searchTime' => [
                    'value' => '<100ms',
                    'label' => 'Keskmine otsingaeg',
                ],
                'wordsSupported' => [
                    'value' => '500K+',
                    'label' => 'Toetatud sõnu',
                ],
                'languagesSupported' => [
                    'value' => '4',
                    'label' => 'Toetatud keeled',
                ],
                'uptime' => [
                    'value' => '99.9%',
                    'label' => 'Töökindlus',
                ],
            ],
        ],
        'gettingStarted' => [
            'title' => 'Alustamine',
            'steps' => [
                'importDatabase' => [
                    'title' => 'Impordi sõnabaas',
                    'description' => 'Alusta sõnaloendi importimisest läbi impordi lehe. Võid kasutada vaikimisi eesti sõnaloendit või laadida oma oma.',
                ],
                'searchAnagrams' => [
                    'title' => 'Otsi anagramme',
                    'description' => 'Sisesta mis tahes sõna otsingu lehel, et leida kõik võimalikud anagrammid kohe kasutades meie optimeeritud algoritme.',
                ],
                'exploreAnalyze' => [
                    'title' => 'Uuri ja analüüsi',
                    'description' => 'Kasuta statistika lehte oma sõnabaasi analüüsimiseks ja vaata otsingu ajalugu ning avasta sõnamalle.',
                ],
            ],
        ],
        'apiDocumentation' => [
            'title' => 'API dokumentatsioon',
            'description' => 'See rakendus kasutab Laravel-põhist REST API-t koos põhjaliku dokumentatsiooniga Swagger/OpenAPI kaudu.',
            'linkLabel' => 'API dokumentatsioon:',
            'viewDocs' => 'Vaata API dokumente',
        ],
    ],

    // Home page UI elements
    'home' => [
        'statistics' => [
            'totalWords' => 'Kokku sõnu',
            'inDatabase' => 'andmebaasis',
            'uniqueAnagrams' => 'Unikaalseid anagramme',
            'combinations' => 'kombinatsioone',
            'mostAnagrams' => 'Enim anagramme',
            'for' => 'sõnale',
            'avgSearchTime' => 'Keskmine otsingaeg',
            'perSearch' => 'otsingu kohta',
        ],
        'features' => [
            'fastSearch' => 'Optimeeritud algoritmid hetkeliseks anagrammide tuvastamiseks',
            'importDatabase' => 'Impordi oma sõnaloendeid ja kohanda andmebaasi',
            'modernInterface' => 'Moodne, reageerimisvõimeline liides, mis on ehitatud Reacti ja Chakra UI abil',
        ],
        'readyToSearch' => 'Valmis otsimiseks!',
        'databaseLoaded' => 'Teie sõnabaas on laaditud {{count}} sõnaga. Alusta anagrammide otsimist nüüd!',
        'startSearching' => 'Alusta otsimist',
    ],

    // Footer
    'footer' => [
        'copyright' => '2025 Eesti anagrammide otsija. Tehtud ❤️ eesti keele jaoks.',
    ],

    // Anagram-specific messages (for API responses)
    'anagrams' => [
        'found' => 'Leiti :count anagramm(i) sõnale ":word"',
        'none_found' => 'Sõnale ":word" anagramme ei leitud',
        'search_completed' => 'Anagrammi otsing lõpetatud',
        'invalid_word' => 'Vigane sõna',
        'word_too_long' => 'Sõna on liiga pikk. Maksimaalne pikkus on :max tähemärki',
        'word_too_short' => 'Sõna on liiga lühike. Minimaalne pikkus on :min tähemärki',
        'empty_word' => 'Sõna parameeter ei saa olla tühi',
        'processing_error' => 'Viga sõna ":word" töötlemisel',
        'unicode_support' => 'Täielik Unicode tugi lubatud',
        'estonian_characters' => 'Eesti tähemärgid tuvastatud: :chars',
    ],

    // Advanced wordbase messages
    'advanced_wordbase' => [
        'unicode_processing' => 'Täiustatud Unicode töötlus lubatud',
        'estonian_optimization' => 'Eesti keele optimeerimine aktiivne',
        'batch_processing' => 'Töödeldakse pakki :current / :total',
        'memory_optimization' => 'Mälu optimeerimine käib',
        'cache_management' => 'Puhvri haldus aktiivne',
        'performance_tuning' => 'Jõudluse häälestus rakendatud',
        'unicode_words_found' => 'Leitud :count sõna Unicode märkidega',
        'canonical_forms_generated' => 'Genereeritud :count unikaalset kanoonilise vormi',
        'index_creation' => 'Optimeeritud andmebaasi indeksite loomine',
        'algorithm_cache_cleared' => 'Algoritmi puhver tühjendatud mälu halduseks',
    ],

    // Validation messages
    'validation' => [
        'required' => 'Väli :attribute on kohustuslik',
        'boolean' => 'Väli :attribute peab olema tõene või väär',
        'string' => 'Väli :attribute peab olema tekst',
        'max_length' => 'Väli :attribute ei tohi ületada :max tähemärki',
        'min_length' => 'Väli :attribute peab olema vähemalt :min tähemärki',
        'invalid_encoding' => 'Väli :attribute sisaldab vigast UTF-8 kodeeringut',
    ],

    // Error codes
    'error_codes' => [
        'INVALID_WORD' => 'Vigane sõna parameeter',
        'WORD_TOO_LONG' => 'Sõna ületab maksimaalse pikkuse',
        'WORD_TOO_SHORT' => 'Sõna on minimaalse pikkuse alt',
        'WORDBASE_NOT_READY' => 'Sõnabaas pole valmis',
        'WORDBASE_EXISTS' => 'Sõnabaas on juba olemas',
        'IMPORT_FAILED' => 'Importimine ebaõnnestus',
        'INVALID_INPUT' => 'Vigane sisend',
        'PROCESSING_ERROR' => 'Töötlemise viga',
        'UNICODE_ERROR' => 'Unicode töötlemise viga',
        'DATABASE_ERROR' => 'Andmebaasi toimingu viga',
        'MEMORY_ERROR' => 'Mälu limiit ületatud',
        'NETWORK_ERROR' => 'Võrguühenduse viga',
    ],

    // Statistics and metadata
    'stats' => [
        'total_words' => 'Kokku sõnu',
        'unique_canonical_forms' => 'Unikaalseid kanoonilisi vorme',
        'average_word_length' => 'Keskmine sõna pikkus',
        'min_word_length' => 'Minimaalne sõna pikkus',
        'max_word_length' => 'Maksimaalne sõna pikkus',
        'unicode_words' => 'Sõnad Unicode märkidega',
        'ascii_words' => 'Ainult ASCII sõnad',
        'estonian_words' => 'Sõnad eesti tähemärkidega',
        'algorithm_type' => 'Algoritmi tüüp',
        'cache_enabled' => 'Puhverdus lubatud',
        'processing_time' => 'Töötlemise aeg',
        'memory_usage' => 'Mälu kasutus',
        'database_size' => 'Andmebaasi suurus',
        'last_updated' => 'Viimati uuendatud',
        'wordbase_ready' => 'Sõnabaas valmis',
        'optimization_level' => 'Optimeerimise tase',
    ],

    // Algorithm messages
    'algorithm' => [
        'sorting' => 'Tähemärkide sortimine algoritm',
        'unicode_optimized' => 'Unicode-optimeeritud algoritm',
        'frequency_map' => 'Tähemärkide sageduse kaardistamine',
        'cache_hit' => 'Puhvri tabamus kanoonilisele vormile',
        'cache_miss' => 'Puhvri möödalask, kanoonilise vormi genereerimine',
        'normalization_applied' => 'Unicode normaliseerimine rakendatud',
        'estonian_mapping' => 'Eesti tähemärkide kaardistamine rakendatud',
        'grapheme_processing' => 'Grafeemi klastrite töötlemine',
        'collation_sorting' => 'Unicode sorteerimise võrdlus',
    ],

    // Time and performance
    'performance' => [
        'search_time' => 'Otsing lõpetatud :time ms jooksul',
        'import_time' => 'Import lõpetatud :time sekundi jooksul',
        'cache_performance' => 'Puhvri tabamuste suhe: :ratio%',
        'memory_peak' => 'Mälu kasutuse tipp: :memory',
        'batch_progress' => 'Pakk :current/:total töödeldud',
        'optimization_applied' => 'Jõudluse optimeerimised rakendatud',
        'index_created' => 'Andmebaasi indeks loodud: :index',
    ],
];
