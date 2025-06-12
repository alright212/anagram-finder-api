<?php

return [
    // General API messages
    'welcome' => 'Tere tulemast Anagrammi Otsija API-sse',
    'success' => 'Toiming lõpetatud edukalt',
    'error' => 'Ilmnes viga',
    'not_found' => 'Ressurssi ei leitud',
    'invalid_request' => 'Vigane päring',
    'service_unavailable' => 'Teenus ajutiselt kättesaamatu',

    // Anagram-specific messages
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

    // Wordbase messages
    'wordbase' => [
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
