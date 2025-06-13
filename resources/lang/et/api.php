<?php

return [
    // Üldised API teated
    'welcome' => 'Tere tulemast Anagrammide Leidja API-sse',
    'success' => 'Toiming edukalt lõpule viidud',
    'error' => 'Tekkis viga',
    'not_found' => 'Ressurssi ei leitud',
    'invalid_request' => 'Vigane päring',
    'service_unavailable' => 'Teenus on ajutiselt kättesaamatu',

    // Levinud kasutajaliidese elemendid
    'common' => [
        'search' => 'Otsi',
        'import' => 'Impordi',
        'about' => 'Teave',
        'home' => 'Avaleht',
        'loading' => 'Laadimine...',
        'error' => 'Viga',
        'success' => 'Õnnestus',
        'cancel' => 'Tühista',
        'save' => 'Salvesta',
        'delete' => 'Kustuta',
        'edit' => 'Muuda',
        'close' => 'Sulge',
    ],

    // Navigatsioonielemendid
    'navigation' => [
        'title' => 'Eesti Anagrammide Leidja',
        'subtitle' => 'Leia sõnade anagramme kiirelt ja lihtsalt',
    ],

    // Otsinguliides
    'search' => [
        'title' => 'Anagrammi otsing',
        'description' => 'Sisesta eestikeelne sõna, et leida selle anagramme',
        'placeholder' => 'Sisesta sõna anagrammide leidmiseks...',
        'searchButton' => 'Otsi anagramme',
        'noResults' => 'Anagramme ei leitud',
        'recentSearches' => 'Hiljutised otsingud',
        'results' => [
            'title' => 'Leitud anagrammid:',
            'count' => 'Kokku: {{count}} anagrammi',
            'executionTime' => 'Otsingu aeg: {{time}}ms',
            'algorithm' => 'Algoritm: {{algorithm}}',
        ],
        'tips' => [
            'title' => '💡 Otsingu nipid',
            'items' => [
                'estonianWords' => 'Parimate tulemuste saamiseks kasuta eestikeelseid sõnu',
                'minimumLength' => 'Sõnad peavad olema vähemalt 2 tähemärki pikad',
                'clickResults' => 'Klõpsa ükskõik millisel anagrammi tulemusel, et otsida selle anagramme',
                'useHistory' => 'Kiireks juurdepääsuks kasuta oma hiljutisi otsinguid',
            ],
        ],
    ],

    // Veateated
    'errors' => [
        'networkError' => 'Võrguühenduse viga',
        'serverError' => 'Serveri viga',
        'invalidInput' => 'Vigane sisend',
        'wordNotFound' => 'Sõna ei leitud',
        'importFailed' => 'Importimine ebaõnnestus',
    ],

    // Sõnabaasi haldus
    'wordbase' => [
        'title' => 'Sõnabaasi import',
        'status' => 'Sõnabaasi olek',
        'totalWords' => 'Sõnu kokku: {{count}}',
        'lastImport' => 'Viimane import: {{date}}',
        'statusLabels' => [
            'total_words' => 'Sõnu kokku',
            'languages' => 'Keeled',
            'last_updated' => 'Viimati uuendatud',
        ],
        'import' => [
            'title' => 'Impordi sõnabaas',
            'description' => 'Impordi uusi sõnu sõnabaasi anagrammide genereerimiseks.',
            'instructions' => [
                'title' => 'Impordi juhised',
                'plain_text' => 'Lihtteksti formaat: Sisesta üks sõna rea kohta',
                'json_format' => 'JSON formaat: Esita stringide(sõnade) massiiv nagu ["sõna1", "sõna2"]',
                'language_selection' => 'Keele valik: Vali sõnadele sobiv keel',
                'duplicates' => 'Duplikaadid: Korduvad sõnad jäetakse automaatselt vahele',
                'processing_time' => 'Töötlemisaeg: Suurte importide puhul võib kuluda mitu sekundit',
            ],
        ],
        'importForm' => [
            'title' => 'Impordi sõnu',
            'content' => 'Sõnad (üks rea kohta)',
            'format' => 'Formaat',
            'language' => 'Keel',
            'importButton' => 'Impordi sõnad',
            'placeholder' => 'Sisesta imporditavad sõnad (tekstivormingus üks rea kohta või JSON-vormingus JSON-massiiv)',
            'failed' => 'Importimine ebaõnnestus',
            'validation' => [
                'wordsRequired' => 'Palun sisesta mõned sõnad',
            ],
        ],
        'formats' => [
            'plaintext' => 'Lihttekst',
            'json' => 'JSON',
        ],
        'languages' => [
            'et' => 'Eesti',
            'en' => 'Inglise',
            'de' => 'Saksa',
            'fr' => 'Prantsuse',
        ],
        // Vananenud API teated tagasiühilduvuse tagamiseks
        'import_started' => 'Sõnabaasi import alustatud',
        'import_completed' => 'Sõnabaasi import edukalt lõpule viidud',
        'import_failed' => 'Sõnabaasi import ebaõnnestus',
        'already_exists' => 'Sõnabaas on juba olemas. Ülekirjutamiseks kasuta force=true',
        'not_ready' => 'Sõnabaas pole saadaval. Palun impordi esmalt sõnabaas',
        'clearing' => 'Olemasoleva sõnabaasi tühjendamine',
        'cleared' => 'Sõnabaas edukalt tühjendatud',
        'empty' => 'Sõnabaas on tühi',
        'status_check' => 'Sõnabaasi oleku kontrollimine',
        'words_imported' => ':count sõna edukalt imporditud',
        'source_unreachable' => 'Sõnaallikas pole kättesaadav',
        'invalid_source' => 'Vigased sõnaallika andmed',
        'processing_words' => 'Sõnade töötlemine',
        'optimizing_database' => 'Andmebaasi indeksite optimeerimine',
        'statistics_generated' => 'Impordi statistika genereeritud',
    ],

    // Teave leht
    'about' => [
        'title' => 'Teave anagrammide leidja kohta',
        'description' => 'See rakendus võimaldab teil leida eestikeelsete sõnade anagramme, kasutades täiustatud algoritme.',
        'features' => [
            'title' => 'Funktsioonid',
            'items' => [
                'fastSearch' => 'Kiire anagrammi otsing',
                'fastSearchDescription' => 'Optimeeritud algoritmid koheseks anagrammide tuvastamiseks',
                'multilingualSupport' => 'Mitmekeelne tugi',
                'multilingualSupportDescription' => 'Tugi eesti, inglise, saksa ja prantsuse keelele',
                'customDatabase' => 'Kohandatav sõnade andmebaas',
                'customDatabaseDescription' => 'Impordi oma sõnaloendeid ja kohanda andmebaasi',
                'modernInterface' => 'Kaasaegne kasutajaliides',
                'modernInterfaceDescription' => 'Ehitatud React 18, TypeScripti ja Chakra UI-ga',
                'realTimeStats' => 'Reaalajas statistika',
                'realTimeStatsDescription' => 'Vaata otsingu jõudlust ja sõnade andmebaasi statistikat',
            ],
        ],
        'algorithm' => [
            'title' => 'Algoritm',
            'description' => 'Kasutame optimeeritud algoritme, mis tagavad kiire ja täpse anagrammide tuvastamise.',
            'types' => [
                'characterFrequency' => [
                    'name' => 'Tähemärkide sageduse analüüs',
                    'description' => 'Kasutab tähemärkide sageduse loendamist tõhusaks anagrammide tuvastamiseks',
                    'complexity' => 'O(n + m)',
                ],
                'sortingBased' => [
                    'name' => 'Sorteerimispõhine võrdlus',
                    'description' => 'Sorteerib tähemärke, et leida anagramme stringide võrdluse kaudu',
                    'complexity' => 'O(n log n)',
                ],
                'hashBased' => [
                    'name' => 'Räsipõhine otsing',
                    'description' => 'Eelnevalt arvutatud räsitabelid ülikiireks anagrammide leidmiseks',
                    'complexity' => 'O(1) otsing',
                ],
            ],
        ],
        'techStack' => [
            'frontend' => [
                'title' => 'Esiosa tehnoloogiad',
                'items' => [
                    'reactTypeScript' => 'React 18 koos TypeScriptiga',
                    'chakraUI' => 'Chakra UI kaasaegse disaini jaoks',
                    'reactRouter' => 'React Router navigeerimiseks',
                    'reactHookForm' => 'React Hook Form vormide jaoks',
                    'i18next' => 'i18next rahvusvahelistumiseks',
                    'axios' => 'Axios API suhtluseks',
                    'zod' => 'Zod valideerimiseks',
                ],
            ],
            'backend' => [
                'title' => 'Tagosa tehnoloogiad',
                'items' => [
                    'laravel' => 'Laravel 11 PHP raamistik',
                    'restfulAPI' => 'RESTful API koos Swaggeri dokumentatsiooniga',
                    'sqlite' => 'SQLite andmebaas',
                    'multiLanguage' => 'Mitmekeelne tugi',
                    'algorithms' => 'Optimeeritud anagrammi algoritmid',
                    'errorHandling' => 'Põhjalik veahaldus',
                    'monitoring' => 'Jõudluse monitooring',
                ],
            ],
        ],
        'performance' => [
            'title' => 'Jõudluse tipphetked',
            'metrics' => [
                'searchTime' => [
                    'value' => '<100ms',
                    'label' => 'Keskmine otsingu aeg',
                ],
                'wordsSupported' => [
                    'value' => '500K+',
                    'label' => 'Toetatud sõnu',
                ],
                'languagesSupported' => [
                    'value' => '4',
                    'label' => 'Toetatud keeli',
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
                    'title' => 'Impordi sõnade andmebaas',
                    'description' => 'Alusta sõnaloendi importimisega Impordi lehe kaudu. Saad kasutada vaikimisi eesti sõnastikku või laadida üles enda oma.',
                ],
                'searchAnagrams' => [
                    'title' => 'Otsi anagramme',
                    'description' => 'Sisesta otsingulehele suvaline sõna, et leida koheselt kõik võimalikud anagrammid, kasutades meie optimeeritud algoritme.',
                ],
                'exploreAnalyze' => [
                    'title' => 'Uuri ja analüüsi',
                    'description' => 'Kasuta statistika lehte oma sõnabaasi analüüsimiseks, otsinguajaloo vaatamiseks ja sõnamustrite avastamiseks.',
                ],
            ],
        ],
        'apiDocumentation' => [
            'title' => 'API dokumentatsioon',
            'description' => 'See rakendus kasutab Laravelil põhinevat REST API-d, mille põhjalik dokumentatsioon on saadaval Swagger/OpenAPI kaudu.',
            'linkLabel' => 'API Dokumentatsioon:',
            'viewDocs' => 'Vaata API Dokke',
        ],
    ],

    // Avalehe kasutajaliidese elemendid
    'home' => [
        'statistics' => [
            'title' => '🏆 Statistika',
            'estonianWords' => 'Eesti sõnad',
            'avgResponse' => 'Keskmine vastus',
            'unicodeSupport' => 'Unicode tugi',
            'lookupTime' => 'Päringu kiirus',
            'totalWords' => 'Sõnu kokku',
            'inDatabase' => 'andmebaasis',
            'uniqueAnagrams' => 'Unikaalseid anagramme',
            'combinations' => 'kombinatsiooni',
            'mostAnagrams' => 'Enim anagramme',
            'for' => 'sõnale',
            'avgSearchTime' => 'Keskmine otsingu aeg',
            'perSearch' => 'otsingu kohta',
        ],
        'features' => [
            'fastSearch' => 'Optimeeritud algoritmid koheseks anagrammide tuvastamiseks',
            'importDatabase' => 'Impordi oma sõnaloendeid otsinguandmebaasi kohandamiseks',
            'modernInterface' => 'Kaasaegne, reageeriv liides, mis on ehitatud Reacti ja Chakra UI-ga',
        ],
        'readyToSearch' => 'Otsinguks valmis!',
        'databaseLoaded' => 'Sinu sõnade andmebaas on laetud {{count}} sõnaga. Alusta anagrammide leidmist kohe!',
        'startSearching' => 'Alusta otsingut',
    ],

    // Jalus
    'footer' => [
        'copyright' => '2025 Eesti Anagrammide Leidja. Tehtud ❤️-ga eesti keele vastu.',
    ],

    // Anagrammi-spetsiifilised teated (API vastuste jaoks)
    'anagrams' => [
        'found' => 'Leitud :count anagrammi sõnale ":word"',
        'none_found' => 'Sõnale ":word" anagramme ei leitud',
        'search_completed' => 'Anagrammi otsing lõpule viidud',
        'invalid_word' => 'Vigane sõna',
        'word_too_long' => 'Sõna on liiga pikk. Maksimaalne pikkus on :max tähemärki',
        'word_too_short' => 'Sõna on liiga lühike. Minimaalne pikkus on :min tähemärki',
        'empty_word' => 'Sõna parameeter ei tohi olla tühi',
        'processing_error' => 'Viga sõna ":word" töötlemisel',
        'unicode_support' => 'Täielik Unicode tugi on lubatud',
        'estonian_characters' => 'Tuvastatud eesti tähemärgid: :chars',
    ],

    // Täiustatud sõnabaasi teated
    'advanced_wordbase' => [
        'unicode_processing' => 'Täiustatud Unicode töötlemine on lubatud',
        'estonian_optimization' => 'Eesti keele optimeerimine on aktiivne',
        'batch_processing' => 'Töödeldakse paketti :current/:total',
        'memory_optimization' => 'Mälu optimeerimine on pooleli',
        'cache_management' => 'Vahemälu haldamine on aktiivne',
        'performance_tuning' => 'Jõudluse häälestamine on rakendatud',
        'unicode_words_found' => 'Leitud :count sõna Unicode tähemärkidega',
        'canonical_forms_generated' => 'Genereeritud :count unikaalset kanoonilist vormi',
        'index_creation' => 'Optimeeritud andmebaasi indeksite loomine',
        'algorithm_cache_cleared' => 'Algoritmi vahemälu tühjendatud mälu haldamiseks',
    ],

    // Valideerimisteated
    'validation' => [
        'required' => 'Väli :attribute on kohustuslik',
        'boolean' => 'Väli :attribute peab olema tõene või väär',
        'string' => 'Väli :attribute peab olema string',
        'max_length' => 'Väli :attribute ei tohi ületada :max tähemärki',
        'min_length' => 'Väli :attribute peab olema vähemalt :min tähemärki pikk',
        'invalid_encoding' => 'Väli :attribute sisaldab vigast UTF-8 kodeeringut',
    ],

    // Veakoodid
    'error_codes' => [
        'INVALID_WORD' => 'Vigane sõna parameeter',
        'WORD_TOO_LONG' => 'Sõna ületab maksimaalset pikkust',
        'WORD_TOO_SHORT' => 'Sõna on lühem kui minimaalne pikkus',
        'WORDBASE_NOT_READY' => 'Sõnabaas ei ole valmis',
        'WORDBASE_EXISTS' => 'Sõnabaas on juba olemas',
        'IMPORT_FAILED' => 'Importimine ebaõnnestus',
        'INVALID_INPUT' => 'Vigane sisend',
        'PROCESSING_ERROR' => 'Töötlemisel tekkis viga',
        'UNICODE_ERROR' => 'Unicode töötlemise viga',
        'DATABASE_ERROR' => 'Andmebaasi operatsiooni viga',
        'MEMORY_ERROR' => 'Mälulimiit ületatud',
        'NETWORK_ERROR' => 'Võrguühenduse viga',
    ],

    // Statistika ja metaandmed
    'stats' => [
        'total_words' => 'Sõnu kokku',
        'unique_canonical_forms' => 'Unikaalsed kanoonilised vormid',
        'average_word_length' => 'Keskmine sõna pikkus',
        'min_word_length' => 'Minimaalne sõna pikkus',
        'max_word_length' => 'Maksimaalne sõna pikkus',
        'unicode_words' => 'Unicode tähemärkidega sõnad',
        'ascii_words' => 'Ainult ASCII sõnad',
        'estonian_words' => 'Eesti tähemärkidega sõnad',
        'algorithm_type' => 'Algoritmi tüüp',
        'cache_enabled' => 'Vahemälu lubatud',
        'processing_time' => 'Töötlemisaeg',
        'memory_usage' => 'Mälukasutus',
        'database_size' => 'Andmebaasi suurus',
        'last_updated' => 'Viimati uuendatud',
        'wordbase_ready' => 'Sõnabaas valmis',
        'optimization_level' => 'Optimeerimise tase',
    ],

    // Algoritmi teated
    'algorithm' => [
        'sorting' => 'Tähemärkide sorteerimise algoritm',
        'unicode_optimized' => 'Unicode-optimeeritud algoritm',
        'frequency_map' => 'Tähemärkide sageduse kaardistamine',
        'cache_hit' => 'Vahemälu tabamus kanoonilise vormi jaoks',
        'cache_miss' => 'Vahemälust möödalask, genereeritakse kanooniline vorm',
        'normalization_applied' => 'Unicode normaliseerimine rakendatud',
        'estonian_mapping' => 'Eesti tähemärkide kaardistamine rakendatud',
        'grapheme_processing' => 'Grafeemiklastrite töötlemine',
        'collation_sorting' => 'Unicode kollatsiooni sorteerimine',
    ],

    // Aeg ja jõudlus
    'performance' => [
        'search_time' => 'Otsing lõpetati :time ms-ga',
        'import_time' => 'Import lõpetati :time sekundiga',
        'cache_performance' => 'Vahemälu tabamuste suhe: :ratio%',
        'memory_peak' => 'Mälu tippkasutus: :memory',
        'batch_progress' => 'Partii :current/:total töödeldud',
        'optimization_applied' => 'Jõudluse optimeerimised rakendatud',
        'index_created' => 'Andmebaasi indeks loodud: :index',
    ],
];
