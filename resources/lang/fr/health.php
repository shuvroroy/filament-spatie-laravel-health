<?php

return [

    'all_checks' => 'Toutes les vérifications',
    'needs_attention' => 'À examiner',
    'none_need_attention' => 'Aucune vérification ne nécessite votre attention.',
    'no_results' => 'Aucun résultat disponible pour le moment.',

    'check_history' => 'Historique récent',
    'recent_runs' => ':count dernières exécutions',
    'latest_run' => 'Dernière exécution',
    'saved_run' => 'Exécution enregistrée',
    'view_details' => 'Voir les détails',
    'recorded_values' => 'Valeurs enregistrées',
    'back_to_latest' => 'Revenir aux derniers résultats',
    'run_unavailable' => 'Cette exécution n’est plus disponible.',

    'status_labels' => [
        'ok' => 'Réussie',
        'failed' => 'Échec',
        'warning' => 'Avertissement',
        'crashed' => 'Erreur d’exécution',
        'skipped' => 'Ignorée',
        'other' => 'Inconnu',
    ],

    'status_groups' => [
        'failed' => 'Échecs',
        'warning' => 'Avertissements',
        'crashed' => 'Contrôles interrompus',
        'skipped' => 'Contrôles ignorés',
    ],

    'status_counts' => [
        'ok' => 'Réussies : :count',
        'other' => 'Autres : :count',
        'failed' => 'Échecs : :count',
        'crashed' => 'Erreurs d’exécution : :count',
        'warning' => 'Avertissements : :count',
        'skipped' => 'Ignorées : :count',
    ],

    'pages' => [
        'health_check_results' => [
            'buttons' => [
                'refresh' => 'Rafraîchir',
                'run_checks' => 'Exécuter les vérifications',
            ],

            'heading' => 'Santé de l\'application',

            'navigation' => [
                'group' => 'Paramètres',
                'label' => 'Santé de l\'application',
            ],

            'notifications' => [
                'check_results' => 'Résultats des vérifications :lastRanAt',
                'results_refreshed' => 'Les résultats du contrôle de santé ont été rafraîchis',
            ],
        ],
    ],

];
