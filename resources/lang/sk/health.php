<?php

return [

    'all_checks' => 'Všetky kontroly',
    'needs_attention' => 'Vyžadujú pozornosť',
    'none_need_attention' => 'Žiadna kontrola nevyžaduje pozornosť.',
    'no_results' => 'Zatiaľ nie sú k dispozícii žiadne výsledky kontrol.',

    'recent_runs' => 'Posledné spustenia (:count)',
    'latest_run' => 'Posledné spustenie',
    'saved_run' => 'Uložený beh',
    'view_details' => 'Zobraziť podrobnosti',
    'recorded_values' => 'Zaznamenané hodnoty',
    'back_to_latest' => 'Späť na najnovšie výsledky',
    'run_unavailable' => 'Tento beh už nie je k dispozícii.',

    'status_labels' => [
        'ok' => 'V poriadku',
        'failed' => 'Zlyhanie',
        'warning' => 'Upozornenie',
        'crashed' => 'Pád',
        'skipped' => 'Preskočené',
        'other' => 'Neznámy stav',
    ],

    'status_groups' => [
        'failed' => 'Zlyhania',
        'warning' => 'Upozornenia',
        'crashed' => 'Havarované kontroly',
        'skipped' => 'Preskočené kontroly',
    ],

    'status_counts' => [
        'ok' => 'V poriadku: :count',
        'other' => 'Ostatné: :count',
        'failed' => 'Zlyhania: :count',
        'crashed' => 'Pády: :count',
        'warning' => 'Upozornenia: :count',
        'skipped' => 'Preskočené: :count',
    ],

    'pages' => [
        'health_check_results' => [
            'buttons' => [
                'refresh' => 'Obnoviť',
            ],

            'heading' => 'Stav aplikácie',

            'navigation' => [
                'group' => 'Nastavenia',
                'label' => 'Stav aplikácie',
            ],

            'notifications' => [
                'check_results' => 'Posledná kontrola: :lastRanAt',
            ],
        ],
    ],

];
