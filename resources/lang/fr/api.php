<?php

return [
    // General API messages
    'welcome' => 'Bienvenue dans l\'API Chercheur d\'Anagrammes',
    'success' => 'Opération terminée avec succès',
    'error' => 'Une erreur s\'est produite',
    'not_found' => 'Ressource non trouvée',
    'invalid_request' => 'Requête invalide',
    'service_unavailable' => 'Service temporairement indisponible',

    // Anagram-specific messages
    'anagrams' => [
        'found' => ':count anagramme(s) trouvé(s) pour ":word"',
        'none_found' => 'Aucun anagramme trouvé pour ":word"',
        'search_completed' => 'Recherche d\'anagrammes terminée',
        'invalid_word' => 'Mot invalide fourni',
        'word_too_long' => 'Mot trop long. Longueur maximale est :max caractères',
        'word_too_short' => 'Mot trop court. Longueur minimale est :min caractères',
        'empty_word' => 'Le paramètre mot ne peut pas être vide',
        'processing_error' => 'Erreur lors du traitement du mot ":word"',
        'unicode_support' => 'Support Unicode complet activé',
        'estonian_characters' => 'Caractères estoniens détectés : :chars',
    ],

    // Wordbase messages
    'wordbase' => [
        'import_started' => 'Import de la base de mots commencé',
        'import_completed' => 'Import de la base de mots terminé avec succès',
        'import_failed' => 'Import de la base de mots échoué',
        'already_exists' => 'La base de mots existe déjà. Utilisez force=true pour écraser',
        'not_ready' => 'Base de mots non disponible. Veuillez d\'abord importer la base de mots',
        'clearing' => 'Suppression de la base de mots existante',
        'cleared' => 'Base de mots supprimée avec succès',
        'empty' => 'La base de mots est vide',
        'status_check' => 'Vérification du statut de la base de mots',
        'words_imported' => ':count mots importés avec succès',
        'source_unreachable' => 'Source de mots inaccessible',
        'invalid_source' => 'Données de source de mots invalides',
        'processing_words' => 'Traitement des mots',
        'optimizing_database' => 'Optimisation des index de base de données',
        'statistics_generated' => 'Statistiques d\'import générées',
    ],

    // Advanced wordbase messages
    'advanced_wordbase' => [
        'unicode_processing' => 'Traitement Unicode avancé activé',
        'estonian_optimization' => 'Optimisation de la langue estonienne active',
        'batch_processing' => 'Traitement du lot :current sur :total',
        'memory_optimization' => 'Optimisation mémoire en cours',
        'cache_management' => 'Gestion du cache active',
        'performance_tuning' => 'Réglage des performances appliqué',
        'unicode_words_found' => ':count mots avec caractères Unicode trouvés',
        'canonical_forms_generated' => ':count formes canoniques uniques générées',
        'index_creation' => 'Création d\'index de base de données optimisés',
        'algorithm_cache_cleared' => 'Cache d\'algorithme vidé pour la gestion mémoire',
    ],

    // Validation messages
    'validation' => [
        'required' => 'Le champ :attribute est requis',
        'boolean' => 'Le champ :attribute doit être vrai ou faux',
        'string' => 'Le champ :attribute doit être une chaîne',
        'max_length' => 'Le champ :attribute ne doit pas dépasser :max caractères',
        'min_length' => 'Le champ :attribute doit faire au moins :min caractères',
        'invalid_encoding' => 'Le champ :attribute contient un encodage UTF-8 invalide',
    ],

    // Error codes
    'error_codes' => [
        'INVALID_WORD' => 'Paramètre mot invalide',
        'WORD_TOO_LONG' => 'Mot dépasse la longueur maximale',
        'WORD_TOO_SHORT' => 'Mot en dessous de la longueur minimale',
        'WORDBASE_NOT_READY' => 'Base de mots pas prête',
        'WORDBASE_EXISTS' => 'Base de mots existe déjà',
        'IMPORT_FAILED' => 'Opération d\'import échouée',
        'INVALID_INPUT' => 'Entrée invalide fournie',
        'PROCESSING_ERROR' => 'Erreur de traitement survenue',
        'UNICODE_ERROR' => 'Erreur de traitement Unicode',
        'DATABASE_ERROR' => 'Erreur d\'opération base de données',
        'MEMORY_ERROR' => 'Limite mémoire dépassée',
        'NETWORK_ERROR' => 'Erreur de connexion réseau',
    ],

    // Statistics and metadata
    'stats' => [
        'total_words' => 'Total des mots',
        'unique_canonical_forms' => 'Formes canoniques uniques',
        'average_word_length' => 'Longueur moyenne des mots',
        'min_word_length' => 'Longueur minimale des mots',
        'max_word_length' => 'Longueur maximale des mots',
        'unicode_words' => 'Mots avec caractères Unicode',
        'ascii_words' => 'Mots ASCII uniquement',
        'estonian_words' => 'Mots avec caractères estoniens',
        'algorithm_type' => 'Type d\'algorithme',
        'cache_enabled' => 'Cache activé',
        'processing_time' => 'Temps de traitement',
        'memory_usage' => 'Utilisation mémoire',
        'database_size' => 'Taille de base de données',
        'last_updated' => 'Dernière mise à jour',
        'wordbase_ready' => 'Base de mots prête',
        'optimization_level' => 'Niveau d\'optimisation',
    ],

    // Algorithm messages
    'algorithm' => [
        'sorting' => 'Algorithme de tri de caractères',
        'unicode_optimized' => 'Algorithme optimisé Unicode',
        'frequency_map' => 'Mappage de fréquence de caractères',
        'cache_hit' => 'Cache hit pour forme canonique',
        'cache_miss' => 'Cache miss, génération forme canonique',
        'normalization_applied' => 'Normalisation Unicode appliquée',
        'estonian_mapping' => 'Mappage caractères estoniens appliqué',
        'grapheme_processing' => 'Traitement cluster graphème',
        'collation_sorting' => 'Tri collation Unicode',
    ],

    // Time and performance
    'performance' => [
        'search_time' => 'Recherche terminée en :time ms',
        'import_time' => 'Import terminé en :time secondes',
        'cache_performance' => 'Taux de réussite cache : :ratio%',
        'memory_peak' => 'Pic d\'utilisation mémoire : :memory',
        'batch_progress' => 'Lot :current/:total traité',
        'optimization_applied' => 'Optimisations de performance appliquées',
        'index_created' => 'Index de base de données créé : :index',
    ],
];
