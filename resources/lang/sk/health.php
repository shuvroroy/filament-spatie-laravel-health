<?php

return [

    'all_checks' => 'Všetky kontroly',
    'needs_attention' => 'Vyžadujú pozornosť',
    'none_need_attention' => 'Žiadna kontrola nevyžaduje pozornosť.',
    'no_results' => 'Zatiaľ nie sú k dispozícii žiadne výsledky kontrol.',

    'recent_runs' => 'Posledné spustenia (:count)',
    'latest_run' => 'Posledné spustenie',

    'status_labels' => [
        'ok' => 'V poriadku',
        'failed' => 'Zlyhanie',
        'warning' => 'Upozornenie',
        'crashed' => 'Pád',
        'skipped' => 'Preskočené',
        'other' => 'Neznámy stav',
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
