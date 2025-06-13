<?php

return [
    // Messages généraux de l'API
    'welcome' => 'Bienvenue sur l\'API Anagram Finder',
    'success' => 'Opération terminée avec succès',
    'error' => 'Une erreur est survenue',
    'not_found' => 'Ressource non trouvée',
    'invalid_request' => 'Requête invalide',
    'service_unavailable' => 'Service temporairement indisponible',

    // Éléments courants de l'interface utilisateur
    'common' => [
        'search' => 'Rechercher',
        'import' => 'Importer',
        'about' => 'À propos',
        'home' => 'Accueil',
        'loading' => 'Chargement...',
        'error' => 'Erreur',
        'success' => 'Succès',
        'cancel' => 'Annuler',
        'save' => 'Enregistrer',
        'delete' => 'Supprimer',
        'edit' => 'Modifier',
        'close' => 'Fermer',
    ],

    // Éléments de navigation
    'navigation' => [
        'title' => 'Chercheur d\'anagrammes estonien',
        'subtitle' => 'Trouvez des anagrammes de mots rapidement et facilement',
    ],

    // Interface de recherche
    'search' => [
        'title' => 'Recherche d\'anagrammes',
        'description' => 'Entrez un mot estonien pour trouver ses anagrammes',
        'placeholder' => 'Entrez un mot pour trouver des anagrammes...',
        'searchButton' => 'Rechercher des anagrammes',
        'noResults' => 'Aucun anagramme trouvé',
        'recentSearches' => 'Recherches récentes',
        'results' => [
            'title' => 'Anagrammes trouvés :',
            'count' => 'Total : {{count}} anagrammes',
            'executionTime' => 'Temps de recherche : {{time}}ms',
            'algorithm' => 'Algorithme : {{algorithm}}',
        ],
        'tips' => [
            'title' => '💡 Astuces de recherche',
            'items' => [
                'estonianWords' => 'Utilisez des mots estoniens pour de meilleurs résultats',
                'minimumLength' => 'Les mots doivent comporter au moins 2 caractères',
                'clickResults' => 'Cliquez sur n\'importe quel résultat d\'anagramme pour rechercher ses anagrammes',
                'useHistory' => 'Utilisez vos recherches récentes pour un accès rapide',
            ],
        ],
    ],

    // Messages d'erreur
    'errors' => [
        'networkError' => 'Erreur de connexion réseau',
        'serverError' => 'Erreur du serveur',
        'invalidInput' => 'Entrée invalide',
        'wordNotFound' => 'Mot non trouvé',
        'importFailed' => 'L\'importation a échoué',
    ],

    // Gestion de la base de mots
    'wordbase' => [
        'title' => 'Importation de la base de mots',
        'status' => 'État de la base de mots',
        'totalWords' => 'Nombre total de mots : {{count}}',
        'lastImport' => 'Dernière importation : {{date}}',
        'statusLabels' => [
            'total_words' => 'Total des mots',
            'languages' => 'Langues',
            'last_updated' => 'Dernière mise à jour',
        ],
        'import' => [
            'title' => 'Importer une base de mots',
            'description' => 'Importez de nouveaux mots dans la base de mots pour la génération d\'anagrammes.',
            'instructions' => [
                'title' => 'Instructions d\'importation',
                'plain_text' => 'Format texte brut : Entrez un mot par ligne',
                'json_format' => 'Format JSON : Fournissez un tableau de chaînes de caractères comme ["mot1", "mot2"]',
                'language_selection' => 'Sélection de la langue : Choisissez la langue appropriée pour les mots',
                'duplicates' => 'Doublons : les mots en double seront automatiquement ignorés',
                'processing_time' => 'Temps de traitement : les importations volumineuses peuvent prendre plusieurs secondes',
            ],
        ],
        'importForm' => [
            'title' => 'Importer des mots',
            'content' => 'Mots (un par ligne)',
            'format' => 'Format',
            'language' => 'Langue',
            'importButton' => 'Importer des mots',
            'placeholder' => 'Entrez les mots à importer (un par ligne pour le format texte, ou un tableau JSON pour le format JSON)',
            'failed' => 'L\'importation a échoué',
            'validation' => [
                'wordsRequired' => 'Veuillez entrer quelques mots',
            ],
        ],
        'formats' => [
            'plaintext' => 'Texte brut',
            'json' => 'JSON',
        ],
        'languages' => [
            'et' => 'Estonien',
            'en' => 'Anglais',
            'de' => 'Allemand',
            'fr' => 'Français',
        ],
        // Messages API hérités pour la compatibilité descendante
        'import_started' => 'Importation de la base de mots démarrée',
        'import_completed' => 'Importation de la base de mots terminée avec succès',
        'import_failed' => 'L\'importation de la base de mots a échoué',
        'already_exists' => 'La base de mots existe déjà. Utilisez force=true pour écraser',
        'not_ready' => 'Base de mots non disponible. Veuillez d\'abord importer la base de mots',
        'clearing' => 'Effacement de la base de mots existante',
        'cleared' => 'Base de mots effacée avec succès',
        'empty' => 'La base de mots est vide',
        'status_check' => 'Vérification de l\'état de la base de mots',
        'words_imported' => ':count mots importés avec succès',
        'source_unreachable' => 'Impossible d\'atteindre la source de mots',
        'invalid_source' => 'Données de source de mots non valides',
        'processing_words' => 'Traitement des mots',
        'optimizing_database' => 'Optimisation des index de la base de données',
        'statistics_generated' => 'Statistiques d\'importation générées',
    ],

    // Page À propos
    'about' => [
        'title' => 'À propos du chercheur d\'anagrammes',
        'description' => 'Cette application vous permet de trouver des anagrammes de mots estoniens à l\'aide d\'algorithmes avancés.',
        'features' => [
            'title' => 'Fonctionnalités',
            'items' => [
                'fastSearch' => 'Recherche rapide d\'anagrammes',
                'fastSearchDescription' => 'Algorithmes optimisés pour une détection instantanée d\'anagrammes',
                'multilingualSupport' => 'Support multilingue',
                'multilingualSupportDescription' => 'Support pour l\'estonien, l\'anglais, l\'allemand et le français',
                'customDatabase' => 'Base de données de mots personnalisable',
                'customDatabaseDescription' => 'Importez vos propres listes de mots et personnalisez la base de données',
                'modernInterface' => 'Interface utilisateur moderne',
                'modernInterfaceDescription' => 'Construit avec React 18, TypeScript et Chakra UI',
                'realTimeStats' => 'Statistiques en temps réel',
                'realTimeStatsDescription' => 'Affichez les performances de recherche et les statistiques de la base de données de mots',
            ],
        ],
        'algorithm' => [
            'title' => 'Algorithme',
            'description' => 'Nous utilisons des algorithmes optimisés qui garantissent une détection rapide et précise des anagrammes.',
            'types' => [
                'characterFrequency' => [
                    'name' => 'Analyse de fréquence des caractères',
                    'description' => 'Utilise le comptage de la fréquence des caractères pour une détection efficace des anagrammes',
                    'complexity' => 'O(n + m)',
                ],
                'sortingBased' => [
                    'name' => 'Comparaison basée sur le tri',
                    'description' => 'Trie les caractères pour trouver des anagrammes par comparaison de chaînes',
                    'complexity' => 'O(n log n)',
                ],
                'hashBased' => [
                    'name' => 'Recherche basée sur le hachage',
                    'description' => 'Tables de hachage pré-calculées pour une récupération ultra-rapide des anagrammes',
                    'complexity' => 'Recherche en O(1)',
                ],
            ],
        ],
        'techStack' => [
            'frontend' => [
                'title' => 'Technologies Frontend',
                'items' => [
                    'reactTypeScript' => 'React 18 avec TypeScript',
                    'chakraUI' => 'Chakra UI pour un design moderne',
                    'reactRouter' => 'React Router pour la navigation',
                    'reactHookForm' => 'React Hook Form pour les formulaires',
                    'i18next' => 'i18next pour l\'internationalisation',
                    'axios' => 'Axios pour la communication API',
                    'zod' => 'Zod pour la validation',
                ],
            ],
            'backend' => [
                'title' => 'Technologies Backend',
                'items' => [
                    'laravel' => 'Framework PHP Laravel 11',
                    'restfulAPI' => 'API RESTful avec documentation Swagger',
                    'sqlite' => 'Base de données SQLite',
                    'multiLanguage' => 'Support multilingue',
                    'algorithms' => 'Algorithmes d\'anagrammes optimisés',
                    'errorHandling' => 'Gestion complète des erreurs',
                    'monitoring' => 'Surveillance des performances',
                ],
            ],
        ],
        'performance' => [
            'title' => 'Points forts des performances',
            'metrics' => [
                'searchTime' => [
                    'value' => '<100ms',
                    'label' => 'Temps de recherche moyen',
                ],
                'wordsSupported' => [
                    'value' => '500K+',
                    'label' => 'Mots pris en charge',
                ],
                'languagesSupported' => [
                    'value' => '4',
                    'label' => 'Langues prises en charge',
                ],
                'uptime' => [
                    'value' => '99.9%',
                    'label' => 'Fiabilité du temps de disponibilité',
                ],
            ],
        ],
        'gettingStarted' => [
            'title' => 'Pour commencer',
            'steps' => [
                'importDatabase' => [
                    'title' => 'Importer une base de données de mots',
                    'description' => 'Commencez par importer une liste de mots via la page Importer. Vous pouvez utiliser la liste de mots estonienne par défaut ou télécharger la vôtre.',
                ],
                'searchAnagrams' => [
                    'title' => 'Rechercher des anagrammes',
                    'description' => 'Entrez n\'importe quel mot dans la page de recherche pour trouver tous les anagrammes possibles instantanément à l\'aide de nos algorithmes optimisés.',
                ],
                'exploreAnalyze' => [
                    'title' => 'Explorer et analyser',
                    'description' => 'Utilisez la page des statistiques pour analyser votre base de mots, afficher l\'historique des recherches et découvrir des modèles de mots.',
                ],
            ],
        ],
        'apiDocumentation' => [
            'title' => 'Documentation de l\'API',
            'description' => 'Cette application utilise une API REST basée sur Laravel avec une documentation complète disponible via Swagger/OpenAPI.',
            'linkLabel' => 'Documentation de l\'API :',
            'viewDocs' => 'Voir la documentation de l\'API',
        ],
    ],

    // Éléments de l'interface utilisateur de la page d'accueil
    'home' => [
        'statistics' => [
            'title' => '🏆 Statistiques de production',
            'estonianWords' => 'Mots estoniens',
            'avgResponse' => 'Réponse moy.',
            'unicodeSupport' => 'Prise en charge Unicode',
            'lookupTime' => 'Temps de recherche',
            'totalWords' => 'Total des mots',
            'inDatabase' => 'dans la base de données',
            'uniqueAnagrams' => 'Anagrammes uniques',
            'combinations' => 'combinaisons',
            'mostAnagrams' => 'Le plus d\'anagrammes',
            'for' => 'pour le mot',
            'avgSearchTime' => 'Temps de recherche moy.',
            'perSearch' => 'par recherche',
        ],
        'features' => [
            'fastSearch' => 'Algorithmes optimisés pour une détection instantanée des anagrammes',
            'importDatabase' => 'Importez vos propres listes de mots pour personnaliser la base de données de recherche',
            'modernInterface' => 'Interface moderne et réactive construite avec React et Chakra UI',
        ],
        'readyToSearch' => 'Prêt à rechercher !',
        'databaseLoaded' => 'Votre base de données de mots est chargée avec {{count}} mots. Commencez à trouver des anagrammes maintenant !',
        'startSearching' => 'Commencer la recherche',
    ],

    // Pied de page
    'footer' => [
        'copyright' => '2025 Chercheur d\'anagrammes estonien. Fait avec ❤️ pour la langue estonienne.',
    ],

    // Messages spécifiques aux anagrammes (pour les réponses de l'API)
    'anagrams' => [
        'found' => ':count anagramme(s) trouvé(s) pour ":word"',
        'none_found' => 'Aucun anagramme trouvé pour ":word"',
        'search_completed' => 'Recherche d\'anagrammes terminée',
        'invalid_word' => 'Mot fourni non valide',
        'word_too_long' => 'Mot trop long. La longueur maximale est de :max caractères',
        'word_too_short' => 'Mot trop court. La longueur minimale est de :min caractères',
        'empty_word' => 'Le paramètre du mot ne peut pas être vide',
        'processing_error' => 'Erreur lors du traitement du mot ":word"',
        'unicode_support' => 'Support Unicode complet activé',
        'estonian_characters' => 'Caractères estoniens détectés : :chars',
    ],

    // Messages avancés de la base de mots
    'advanced_wordbase' => [
        'unicode_processing' => 'Traitement Unicode avancé activé',
        'estonian_optimization' => 'Optimisation de la langue estonienne active',
        'batch_processing' => 'Traitement du lot :current sur :total',
        'memory_optimization' => 'Optimisation de la mémoire en cours',
        'cache_management' => 'Gestion du cache active',
        'performance_tuning' => 'Réglage des performances appliqué',
        'unicode_words_found' => ':count mots avec des caractères Unicode trouvés',
        'canonical_forms_generated' => ':count formulaires canoniques uniques générés',
        'index_creation' => 'Création d\'index de base de données optimisés',
        'algorithm_cache_cleared' => 'Cache de l\'algorithme vidé pour la gestion de la mémoire',
    ],

    // Messages de validation
    'validation' => [
        'required' => 'Le champ :attribute est obligatoire',
        'boolean' => 'Le champ :attribute doit être vrai ou faux',
        'string' => 'Le champ :attribute doit être une chaîne de caractères',
        'max_length' => 'Le champ :attribute ne doit pas dépasser :max caractères',
        'min_length' => 'Le champ :attribute doit comporter au moins :min caractères',
        'invalid_encoding' => 'Le champ :attribute contient un encodage UTF-8 non valide',
    ],

    // Codes d'erreur
    'error_codes' => [
        'INVALID_WORD' => 'Paramètre de mot non valide',
        'WORD_TOO_LONG' => 'Le mot dépasse la longueur maximale',
        'WORD_TOO_SHORT' => 'Le mot est en dessous de la longueur minimale',
        'WORDBASE_NOT_READY' => 'La base de mots n\'est pas prête',
        'WORDBASE_EXISTS' => 'La base de mots existe déjà',
        'IMPORT_FAILED' => 'L\'opération d\'importation a échoué',
        'INVALID_INPUT' => 'Entrée fournie non valide',
        'PROCESSING_ERROR' => 'Une erreur de traitement s\'est produite',
        'UNICODE_ERROR' => 'Erreur de traitement Unicode',
        'DATABASE_ERROR' => 'Erreur d\'opération de la base de données',
        'MEMORY_ERROR' => 'Limite de mémoire dépassée',
        'NETWORK_ERROR' => 'Erreur de connexion réseau',
    ],

    // Statistiques et métadonnées
    'stats' => [
        'total_words' => 'Nombre total de mots',
        'unique_canonical_forms' => 'Formes canoniques uniques',
        'average_word_length' => 'Longueur moyenne des mots',
        'min_word_length' => 'Longueur minimale des mots',
        'max_word_length' => 'Longueur maximale des mots',
        'unicode_words' => 'Mots avec des caractères Unicode',
        'ascii_words' => 'Mots ASCII uniquement',
        'estonian_words' => 'Mots avec des caractères estoniens',
        'algorithm_type' => 'Type d\'algorithme',
        'cache_enabled' => 'Mise en cache activée',
        'processing_time' => 'Temps de traitement',
        'memory_usage' => 'Utilisation de la mémoire',
        'database_size' => 'Taille de la base de données',
        'last_updated' => 'Dernière mise à jour',
        'wordbase_ready' => 'Base de mots prête',
        'optimization_level' => 'Niveau d\'optimisation',
    ],

    // Messages de l'algorithme
    'algorithm' => [
        'sorting' => 'Algorithme de tri des caractères',
        'unicode_optimized' => 'Algorithme optimisé pour Unicode',
        'frequency_map' => 'Mappage de fréquence des caractères',
        'cache_hit' => 'Correspondance dans le cache pour la forme canonique',
        'cache_miss' => 'Absence dans le cache, génération de la forme canonique',
        'normalization_applied' => 'Normalisation Unicode appliquée',
        'estonian_mapping' => 'Mappage des caractères estoniens appliqué',
        'grapheme_processing' => 'Traitement des groupes de graphèmes',
        'collation_sorting' => 'Tri par collation Unicode',
    ],

    // Temps et performances
    'performance' => [
        'search_time' => 'Recherche terminée en :time ms',
        'import_time' => 'Importation terminée en :time secondes',
        'cache_performance' => 'Taux de réussite du cache : :ratio%',
        'memory_peak' => 'Utilisation maximale de la mémoire : :memory',
        'batch_progress' => 'Lot :current/:total traité',
        'optimization_applied' => 'Optimisations des performances appliquées',
        'index_created' => 'Index de base de données créé : :index',
    ],
];
