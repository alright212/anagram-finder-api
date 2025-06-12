<?php

return [
    // General API messages
    'welcome' => 'Willkommen bei der Anagramm-Finder API',
    'success' => 'Operation erfolgreich abgeschlossen',
    'error' => 'Ein Fehler ist aufgetreten',
    'not_found' => 'Ressource nicht gefunden',
    'invalid_request' => 'Ungültige Anfrage',
    'service_unavailable' => 'Service vorübergehend nicht verfügbar',

    // Anagram-specific messages
    'anagrams' => [
        'found' => ':count Anagramm(e) für ":word" gefunden',
        'none_found' => 'Keine Anagramme für ":word" gefunden',
        'search_completed' => 'Anagramm-Suche abgeschlossen',
        'invalid_word' => 'Ungültiges Wort angegeben',
        'word_too_long' => 'Wort zu lang. Maximale Länge ist :max Zeichen',
        'word_too_short' => 'Wort zu kurz. Minimale Länge ist :min Zeichen',
        'empty_word' => 'Wort-Parameter darf nicht leer sein',
        'processing_error' => 'Fehler bei der Verarbeitung des Wortes ":word"',
        'unicode_support' => 'Vollständige Unicode-Unterstützung aktiviert',
        'estonian_characters' => 'Estnische Zeichen erkannt: :chars',
    ],

    // Wordbase messages
    'wordbase' => [
        'import_started' => 'Wortbasis-Import gestartet',
        'import_completed' => 'Wortbasis-Import erfolgreich abgeschlossen',
        'import_failed' => 'Wortbasis-Import fehlgeschlagen',
        'already_exists' => 'Wortbasis existiert bereits. Verwenden Sie force=true zum Überschreiben',
        'not_ready' => 'Wortbasis nicht verfügbar. Bitte importieren Sie zuerst die Wortbasis',
        'clearing' => 'Vorhandene Wortbasis wird gelöscht',
        'cleared' => 'Wortbasis erfolgreich gelöscht',
        'empty' => 'Wortbasis ist leer',
        'status_check' => 'Wortbasis-Status wird überprüft',
        'words_imported' => ':count Wörter erfolgreich importiert',
        'source_unreachable' => 'Wortquelle nicht erreichbar',
        'invalid_source' => 'Ungültige Wortquellen-Daten',
        'processing_words' => 'Wörter werden verarbeitet',
        'optimizing_database' => 'Datenbank-Indizes werden optimiert',
        'statistics_generated' => 'Import-Statistiken generiert',
    ],

    // Advanced wordbase messages
    'advanced_wordbase' => [
        'unicode_processing' => 'Erweiterte Unicode-Verarbeitung aktiviert',
        'estonian_optimization' => 'Estnische Sprachoptimierung aktiv',
        'batch_processing' => 'Batch :current von :total wird verarbeitet',
        'memory_optimization' => 'Speicheroptimierung läuft',
        'cache_management' => 'Cache-Verwaltung aktiv',
        'performance_tuning' => 'Leistungsoptimierung angewendet',
        'unicode_words_found' => ':count Wörter mit Unicode-Zeichen gefunden',
        'canonical_forms_generated' => ':count eindeutige kanonische Formen generiert',
        'index_creation' => 'Optimierte Datenbank-Indizes werden erstellt',
        'algorithm_cache_cleared' => 'Algorithmus-Cache für Speicherverwaltung geleert',
    ],

    // Validation messages
    'validation' => [
        'required' => 'Das Feld :attribute ist erforderlich',
        'boolean' => 'Das Feld :attribute muss wahr oder falsch sein',
        'string' => 'Das Feld :attribute muss eine Zeichenkette sein',
        'max_length' => 'Das Feld :attribute darf nicht länger als :max Zeichen sein',
        'min_length' => 'Das Feld :attribute muss mindestens :min Zeichen lang sein',
        'invalid_encoding' => 'Das Feld :attribute enthält ungültige UTF-8-Kodierung',
    ],

    // Error codes
    'error_codes' => [
        'INVALID_WORD' => 'Ungültiger Wort-Parameter',
        'WORD_TOO_LONG' => 'Wort überschreitet maximale Länge',
        'WORD_TOO_SHORT' => 'Wort unter minimaler Länge',
        'WORDBASE_NOT_READY' => 'Wortbasis ist nicht bereit',
        'WORDBASE_EXISTS' => 'Wortbasis existiert bereits',
        'IMPORT_FAILED' => 'Import-Operation fehlgeschlagen',
        'INVALID_INPUT' => 'Ungültige Eingabe',
        'PROCESSING_ERROR' => 'Verarbeitungsfehler aufgetreten',
        'UNICODE_ERROR' => 'Unicode-Verarbeitungsfehler',
        'DATABASE_ERROR' => 'Datenbank-Operationsfehler',
        'MEMORY_ERROR' => 'Speicherlimit überschritten',
        'NETWORK_ERROR' => 'Netzwerkverbindungsfehler',
    ],

    // Statistics and metadata
    'stats' => [
        'total_words' => 'Gesamte Wörter',
        'unique_canonical_forms' => 'Eindeutige kanonische Formen',
        'average_word_length' => 'Durchschnittliche Wortlänge',
        'min_word_length' => 'Minimale Wortlänge',
        'max_word_length' => 'Maximale Wortlänge',
        'unicode_words' => 'Wörter mit Unicode-Zeichen',
        'ascii_words' => 'Nur ASCII-Wörter',
        'estonian_words' => 'Wörter mit estnischen Zeichen',
        'algorithm_type' => 'Algorithmus-Typ',
        'cache_enabled' => 'Caching aktiviert',
        'processing_time' => 'Verarbeitungszeit',
        'memory_usage' => 'Speicherverbrauch',
        'database_size' => 'Datenbankgröße',
        'last_updated' => 'Zuletzt aktualisiert',
        'wordbase_ready' => 'Wortbasis bereit',
        'optimization_level' => 'Optimierungsgrad',
    ],

    // Algorithm messages
    'algorithm' => [
        'sorting' => 'Zeichensortierungs-Algorithmus',
        'unicode_optimized' => 'Unicode-optimierter Algorithmus',
        'frequency_map' => 'Zeichenhäufigkeits-Mapping',
        'cache_hit' => 'Cache-Treffer für kanonische Form',
        'cache_miss' => 'Cache-Fehltreffer, kanonische Form wird generiert',
        'normalization_applied' => 'Unicode-Normalisierung angewendet',
        'estonian_mapping' => 'Estnische Zeichenzuordnung angewendet',
        'grapheme_processing' => 'Graphem-Cluster-Verarbeitung',
        'collation_sorting' => 'Unicode-Kollations-Sortierung',
    ],

    // Time and performance
    'performance' => [
        'search_time' => 'Suche in :time ms abgeschlossen',
        'import_time' => 'Import in :time Sekunden abgeschlossen',
        'cache_performance' => 'Cache-Trefferquote: :ratio%',
        'memory_peak' => 'Maximaler Speicherverbrauch: :memory',
        'batch_progress' => 'Batch :current/:total verarbeitet',
        'optimization_applied' => 'Leistungsoptimierungen angewendet',
        'index_created' => 'Datenbank-Index erstellt: :index',
    ],
];
