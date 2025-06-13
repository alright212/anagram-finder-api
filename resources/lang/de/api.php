<?php

return [
    // Allgemeine API-Meldungen
    'welcome' => 'Willkommen bei der Anagramm-Finder-API',
    'success' => 'Vorgang erfolgreich abgeschlossen',
    'error' => 'Ein Fehler ist aufgetreten',
    'not_found' => 'Ressource nicht gefunden',
    'invalid_request' => 'Ungültige Anfrage',
    'service_unavailable' => 'Dienst vorübergehend nicht verfügbar',

    // Allgemeine UI-Elemente
    'common' => [
        'search' => 'Suchen',
        'import' => 'Importieren',
        'about' => 'Über',
        'home' => 'Startseite',
        'loading' => 'Wird geladen...',
        'error' => 'Fehler',
        'success' => 'Erfolg',
        'cancel' => 'Abbrechen',
        'save' => 'Speichern',
        'delete' => 'Löschen',
        'edit' => 'Bearbeiten',
        'close' => 'Schließen',
    ],

    // Navigationselemente
    'navigation' => [
        'title' => 'Estnischer Anagramm-Finder',
        'subtitle' => 'Finden Sie Wort-Anagramme schnell und einfach',
    ],

    // Suchoberfläche
    'search' => [
        'title' => 'Anagramm-Suche',
        'description' => 'Geben Sie ein estnisches Wort ein, um dessen Anagramme zu finden',
        'placeholder' => 'Geben Sie ein Wort ein, um Anagramme zu finden...',
        'searchButton' => 'Anagramme suchen',
        'noResults' => 'Keine Anagramme gefunden',
        'recentSearches' => 'Letzte Suchen',
        'results' => [
            'title' => 'Gefundene Anagramme:',
            'count' => 'Gesamt: {{count}} Anagramme',
            'executionTime' => 'Suchzeit: {{time}}ms',
            'algorithm' => 'Algorithmus: {{algorithm}}',
        ],
        'tips' => [
            'title' => '💡 Suchtipps',
            'items' => [
                'estonianWords' => 'Verwenden Sie estnische Wörter für die besten Ergebnisse',
                'minimumLength' => 'Wörter müssen mindestens 2 Zeichen lang sein',
                'clickResults' => 'Klicken Sie auf ein Anagramm-Ergebnis, um dessen Anagramme zu suchen',
                'useHistory' => 'Nutzen Sie Ihre letzten Suchen für einen schnellen Zugriff',
            ],
        ],
    ],

    // Fehlermeldungen
    'errors' => [
        'networkError' => 'Netzwerkverbindungsfehler',
        'serverError' => 'Serverfehler',
        'invalidInput' => 'Ungültige Eingabe',
        'wordNotFound' => 'Wort nicht gefunden',
        'importFailed' => 'Import fehlgeschlagen',
    ],

    // Wortbasis-Verwaltung
    'wordbase' => [
        'title' => 'Wortbasis-Import',
        'status' => 'Wortbasis-Status',
        'totalWords' => 'Wörter insgesamt: {{count}}',
        'lastImport' => 'Letzter Import: {{date}}',
        'statusLabels' => [
            'total_words' => 'Wörter insgesamt',
            'languages' => 'Sprachen',
            'last_updated' => 'Zuletzt aktualisiert',
        ],
        'import' => [
            'title' => 'Wortbasis importieren',
            'description' => 'Importieren Sie neue Wörter in die Wortbasis zur Anagramm-Generierung.',
            'instructions' => [
                'title' => 'Importanweisungen',
                'plain_text' => 'Einfachtextformat: Geben Sie ein Wort pro Zeile ein',
                'json_format' => 'JSON-Format: Geben Sie ein Array von Zeichenfolgen an, z. B. ["wort1", "wort2"]',
                'language_selection' => 'Sprachauswahl: Wählen Sie die passende Sprache für die Wörter',
                'duplicates' => 'Duplikate: Doppelte Wörter werden automatisch übersprungen',
                'processing_time' => 'Verarbeitungszeit: Große Importe können mehrere Sekunden dauern',
            ],
        ],
        'importForm' => [
            'title' => 'Wörter importieren',
            'content' => 'Wörter (eines pro Zeile)',
            'format' => 'Format',
            'language' => 'Sprache',
            'importButton' => 'Wörter importieren',
            'placeholder' => 'Geben Sie zu importierende Wörter ein (eines pro Zeile für Textformat oder JSON-Array für JSON-Format)',
            'failed' => 'Import fehlgeschlagen',
            'validation' => [
                'wordsRequired' => 'Bitte geben Sie einige Wörter ein',
            ],
        ],
        'formats' => [
            'plaintext' => 'Einfacher Text',
            'json' => 'JSON',
        ],
        'languages' => [
            'et' => 'Estnisch',
            'en' => 'Englisch',
            'de' => 'Deutsch',
            'fr' => 'Französisch',
        ],
        // Veraltete API-Meldungen für Abwärtskompatibilität
        'import_started' => 'Wortbasis-Import gestartet',
        'import_completed' => 'Wortbasis-Import erfolgreich abgeschlossen',
        'import_failed' => 'Wortbasis-Import fehlgeschlagen',
        'already_exists' => 'Wortbasis existiert bereits. Verwenden Sie force=true zum Überschreiben',
        'not_ready' => 'Wortbasis nicht verfügbar. Bitte importieren Sie zuerst die Wortbasis',
        'clearing' => 'Bestehende Wortbasis wird gelöscht',
        'cleared' => 'Wortbasis erfolgreich gelöscht',
        'empty' => 'Wortbasis ist leer',
        'status_check' => 'Wortbasis-Status wird überprüft',
        'words_imported' => ':count Wörter erfolgreich importiert',
        'source_unreachable' => 'Wortquelle nicht erreichbar',
        'invalid_source' => 'Ungültige Wortquellendaten',
        'processing_words' => 'Wörter werden verarbeitet',
        'optimizing_database' => 'Datenbankindizes werden optimiert',
        'statistics_generated' => 'Importstatistiken generiert',
    ],

    // "Über"-Seite
    'about' => [
        'title' => 'Über den Anagramm-Finder',
        'description' => 'Diese Anwendung ermöglicht es Ihnen, mit fortschrittlichen Algorithmen Anagramme estnischer Wörter zu finden.',
        'features' => [
            'title' => 'Funktionen',
            'items' => [
                'fastSearch' => 'Schnelle Anagramm-Suche',
                'fastSearchDescription' => 'Optimierte Algorithmen zur sofortigen Anagramm-Erkennung',
                'multilingualSupport' => 'Mehrsprachige Unterstützung',
                'multilingualSupportDescription' => 'Unterstützung für Estnisch, Englisch, Deutsch und Französisch',
                'customDatabase' => 'Anpassbare Wortdatenbank',
                'customDatabaseDescription' => 'Importieren Sie Ihre eigenen Wortlisten und passen Sie die Datenbank an',
                'modernInterface' => 'Moderne Benutzeroberfläche',
                'modernInterfaceDescription' => 'Erstellt mit React 18, TypeScript und Chakra UI',
                'realTimeStats' => 'Echtzeit-Statistiken',
                'realTimeStatsDescription' => 'Sehen Sie sich die Suchleistung und die Statistiken der Wortdatenbank an',
            ],
        ],
        'algorithm' => [
            'title' => 'Algorithmus',
            'description' => 'Wir verwenden optimierte Algorithmen, die eine schnelle und genaue Anagramm-Erkennung gewährleisten.',
            'types' => [
                'characterFrequency' => [
                    'name' => 'Zeichenfrequenzanalyse',
                    'description' => 'Verwendet die Zählung der Zeichenhäufigkeit zur effizienten Anagramm-Erkennung',
                    'complexity' => 'O(n + m)',
                ],
                'sortingBased' => [
                    'name' => 'Sortierbasierter Vergleich',
                    'description' => 'Sortiert Zeichen, um Anagramme durch Zeichenfolgenvergleich zu finden',
                    'complexity' => 'O(n log n)',
                ],
                'hashBased' => [
                    'name' => 'Hash-basierte Suche',
                    'description' => 'Vorberechnete Hash-Tabellen für ultraschnellen Anagramm-Abruf',
                    'complexity' => 'O(1) Suche',
                ],
            ],
        ],
        'techStack' => [
            'frontend' => [
                'title' => 'Frontend-Technologien',
                'items' => [
                    'reactTypeScript' => 'React 18 mit TypeScript',
                    'chakraUI' => 'Chakra UI für modernes Design',
                    'reactRouter' => 'React Router für die Navigation',
                    'reactHookForm' => 'React Hook Form für Formulare',
                    'i18next' => 'i18next für die Internationalisierung',
                    'axios' => 'Axios für die API-Kommunikation',
                    'zod' => 'Zod zur Validierung',
                ],
            ],
            'backend' => [
                'title' => 'Backend-Technologien',
                'items' => [
                    'laravel' => 'Laravel 11 PHP Framework',
                    'restfulAPI' => 'RESTful API mit Swagger-Dokumentation',
                    'sqlite' => 'SQLite-Datenbank',
                    'multiLanguage' => 'Mehrsprachige Unterstützung',
                    'algorithms' => 'Optimierte Anagramm-Algorithmen',
                    'errorHandling' => 'Umfassende Fehlerbehandlung',
                    'monitoring' => 'Leistungsüberwachung',
                ],
            ],
        ],
        'performance' => [
            'title' => 'Leistungs-Highlights',
            'metrics' => [
                'searchTime' => [
                    'value' => '<100ms',
                    'label' => 'Durchschnittliche Suchzeit',
                ],
                'wordsSupported' => [
                    'value' => '500K+',
                    'label' => 'Unterstützte Wörter',
                ],
                'languagesSupported' => [
                    'value' => '4',
                    'label' => 'Unterstützte Sprachen',
                ],
                'uptime' => [
                    'value' => '99.9%',
                    'label' => 'Betriebszeitzuverlässigkeit',
                ],
            ],
        ],
        'gettingStarted' => [
            'title' => 'Erste Schritte',
            'steps' => [
                'importDatabase' => [
                    'title' => 'Wortdatenbank importieren',
                    'description' => 'Beginnen Sie mit dem Importieren einer Wortliste über die Importseite. Sie können die standardmäßige estnische Wortliste verwenden oder Ihre eigene hochladen.',
                ],
                'searchAnagrams' => [
                    'title' => 'Nach Anagrammen suchen',
                    'description' => 'Geben Sie ein beliebiges Wort auf der Suchseite ein, um mit unseren optimierten Algorithmen sofort alle möglichen Anagramme zu finden.',
                ],
                'exploreAnalyze' => [
                    'title' => 'Erkunden und Analysieren',
                    'description' => 'Verwenden Sie die Statistikseite, um Ihre Wortbasis zu analysieren, den Suchverlauf anzuzeigen und Wortmuster zu entdecken.',
                ],
            ],
        ],
        'apiDocumentation' => [
            'title' => 'API-Dokumentation',
            'description' => 'Diese Anwendung verwendet eine Laravel-basierte REST-API mit umfassender Dokumentation, die über Swagger/OpenAPI verfügbar ist.',
            'linkLabel' => 'API-Dokumentation:',
            'viewDocs' => 'API-Doku anzeigen',
        ],
    ],

    // UI-Elemente der Startseite
    'home' => [
        'statistics' => [
            'title' => '🏆 Produktionsstatistik',
            'estonianWords' => 'Estnische Wörter',
            'avgResponse' => 'Durchschn. Antwort',
            'unicodeSupport' => 'Unicode-Unterstützung',
            'lookupTime' => 'Suchzeit',
            'totalWords' => 'Wörter insgesamt',
            'inDatabase' => 'in der Datenbank',
            'uniqueAnagrams' => 'Einzigartige Anagramme',
            'combinations' => 'Kombinationen',
            'mostAnagrams' => 'Meiste Anagramme',
            'for' => 'für das Wort',
            'avgSearchTime' => 'Durchschn. Suchzeit',
            'perSearch' => 'pro Suche',
        ],
        'features' => [
            'fastSearch' => 'Optimierte Algorithmen zur sofortigen Anagramm-Erkennung',
            'importDatabase' => 'Importieren Sie Ihre eigenen Wortlisten, um die Suchdatenbank anzupassen',
            'modernInterface' => 'Moderne, ansprechende Benutzeroberfläche, erstellt mit React und Chakra UI',
        ],
        'readyToSearch' => 'Bereit zum Suchen!',
        'databaseLoaded' => 'Ihre Wortdatenbank ist mit {{count}} Wörtern geladen. Beginnen Sie jetzt mit der Suche nach Anagrammen!',
        'startSearching' => 'Suche starten',
    ],

    // Fußzeile
    'footer' => [
        'copyright' => '2025 Estnischer Anagramm-Finder. Mit ❤️ für die estnische Sprache gemacht.',
    ],

    // Anagramm-spezifische Meldungen (für API-Antworten)
    'anagrams' => [
        'found' => ':count Anagramm(e) für ":word" gefunden',
        'none_found' => 'Keine Anagramme für ":word" gefunden',
        'search_completed' => 'Anagramm-Suche abgeschlossen',
        'invalid_word' => 'Ungültiges Wort angegeben',
        'word_too_long' => 'Wort zu lang. Maximale Länge beträgt :max Zeichen',
        'word_too_short' => 'Wort zu kurz. Mindestlänge beträgt :min Zeichen',
        'empty_word' => 'Wortparameter darf nicht leer sein',
        'processing_error' => 'Fehler bei der Verarbeitung von Wort ":word"',
        'unicode_support' => 'Volle Unicode-Unterstützung aktiviert',
        'estonian_characters' => 'Estnische Zeichen erkannt: :chars',
    ],

    // Erweiterte Wortbasis-Meldungen
    'advanced_wordbase' => [
        'unicode_processing' => 'Erweiterte Unicode-Verarbeitung aktiviert',
        'estonian_optimization' => 'Optimierung für die estnische Sprache aktiv',
        'batch_processing' => 'Verarbeite Stapel :current von :total',
        'memory_optimization' => 'Speicheroptimierung läuft',
        'cache_management' => 'Cache-Verwaltung aktiv',
        'performance_tuning' => 'Leistungsoptimierung angewendet',
        'unicode_words_found' => ':count Wörter mit Unicode-Zeichen gefunden',
        'canonical_forms_generated' => ':count einzigartige kanonische Formen generiert',
        'index_creation' => 'Optimierte Datenbankindizes werden erstellt',
        'algorithm_cache_cleared' => 'Algorithmus-Cache zur Speicherverwaltung geleert',
    ],

    // Validierungsmeldungen
    'validation' => [
        'required' => 'Das Feld :attribute ist erforderlich',
        'boolean' => 'Das Feld :attribute muss wahr oder falsch sein',
        'string' => 'Das Feld :attribute muss eine Zeichenfolge sein',
        'max_length' => 'Das Feld :attribute darf :max Zeichen nicht überschreiten',
        'min_length' => 'Das Feld :attribute muss mindestens :min Zeichen lang sein',
        'invalid_encoding' => 'Das Feld :attribute enthält eine ungültige UTF-8-Kodierung',
    ],

    // Fehlercodes
    'error_codes' => [
        'INVALID_WORD' => 'Ungültiger Wortparameter',
        'WORD_TOO_LONG' => 'Wort überschreitet maximale Länge',
        'WORD_TOO_SHORT' => 'Wort unterschreitet Mindestlänge',
        'WORDBASE_NOT_READY' => 'Wortbasis ist nicht bereit',
        'WORDBASE_EXISTS' => 'Wortbasis existiert bereits',
        'IMPORT_FAILED' => 'Importvorgang fehlgeschlagen',
        'INVALID_INPUT' => 'Ungültige Eingabe bereitgestellt',
        'PROCESSING_ERROR' => 'Verarbeitungsfehler aufgetreten',
        'UNICODE_ERROR' => 'Unicode-Verarbeitungsfehler',
        'DATABASE_ERROR' => 'Datenbankoperationsfehler',
        'MEMORY_ERROR' => 'Speicherlimit überschritten',
        'NETWORK_ERROR' => 'Netzwerkverbindungsfehler',
    ],

    // Statistiken und Metadaten
    'stats' => [
        'total_words' => 'Wörter insgesamt',
        'unique_canonical_forms' => 'Einzigartige kanonische Formen',
        'average_word_length' => 'Durchschnittliche Wortlänge',
        'min_word_length' => 'Minimale Wortlänge',
        'max_word_length' => 'Maximale Wortlänge',
        'unicode_words' => 'Wörter mit Unicode-Zeichen',
        'ascii_words' => 'Nur-ASCII-Wörter',
        'estonian_words' => 'Wörter mit estnischen Zeichen',
        'algorithm_type' => 'Algorithmus-Typ',
        'cache_enabled' => 'Caching aktiviert',
        'processing_time' => 'Verarbeitungszeit',
        'memory_usage' => 'Speichernutzung',
        'database_size' => 'Datenbankgröße',
        'last_updated' => 'Zuletzt aktualisiert',
        'wordbase_ready' => 'Wortbasis bereit',
        'optimization_level' => 'Optimierungsstufe',
    ],

    // Algorithmus-Meldungen
    'algorithm' => [
        'sorting' => 'Zeichensortieralgorithmus',
        'unicode_optimized' => 'Unicode-optimierter Algorithmus',
        'frequency_map' => 'Zeichenfrequenz-Mapping',
        'cache_hit' => 'Cache-Treffer für kanonische Form',
        'cache_miss' => 'Cache-Fehlschlag, kanonische Form wird generiert',
        'normalization_applied' => 'Unicode-Normalisierung angewendet',
        'estonian_mapping' => 'Estnisches Zeichen-Mapping angewendet',
        'grapheme_processing' => 'Graphem-Cluster-Verarbeitung',
        'collation_sorting' => 'Unicode-Kollationssortierung',
    ],

    // Zeit und Leistung
    'performance' => [
        'search_time' => 'Suche in :time ms abgeschlossen',
        'import_time' => 'Import in :time Sekunden abgeschlossen',
        'cache_performance' => 'Cache-Trefferquote: :ratio%',
        'memory_peak' => 'Spitzenspeichernutzung: :memory',
        'batch_progress' => 'Stapel :current/:total verarbeitet',
        'optimization_applied' => 'Leistungsoptimierungen angewendet',
        'index_created' => 'Datenbankindex erstellt: :index',
    ],
];
