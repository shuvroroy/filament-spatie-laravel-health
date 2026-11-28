<?php

return [

    'all_checks' => 'Všechny kontroly',
    'needs_attention' => 'Vyžadují pozornost',
    'none_need_attention' => 'Žádná kontrola nevyžaduje pozornost.',
    'no_results' => 'Výsledky kontrol zatím nejsou k dispozici.',

    'recent_runs' => 'Poslední běhy (:count)',
    'latest_run' => 'Poslední běh',
    'saved_run' => 'Uložený běh',
    'view_details' => 'Zobrazit podrobnosti',
    'recorded_values' => 'Zaznamenané hodnoty',
    'back_to_latest' => 'Zpět na nejnovější výsledky',
    'run_unavailable' => 'Tento běh již není k dispozici.',

    'status_labels' => [
        'ok' => 'V pořádku',
        'failed' => 'Selhání',
        'warning' => 'Varování',
        'crashed' => 'Pád',
        'skipped' => 'Přeskočeno',
        'other' => 'Neznámý stav',
    ],

    'status_groups' => [
        'failed' => 'Selhání',
        'warning' => 'Varování',
        'crashed' => 'Havarované kontroly',
        'skipped' => 'Přeskočené kontroly',
    ],

    'status_counts' => [
        'ok' => 'V pořádku: :count',
        'other' => 'Ostatní: :count',
        'failed' => 'Selhání: :count',
        'crashed' => 'Pády: :count',
        'warning' => 'Varování: :count',
        'skipped' => 'Přeskočeno: :count',
    ],

    'pages' => [
        'health_check_results' => [
            'buttons' => [
                'refresh' => 'Obnovit',
            ],

            'heading' => 'Stav aplikace',

            'navigation' => [
                'group' => 'Nastavení',
                'label' => 'Stav aplikace',
            ],

            'notifications' => [
                'check_results' => 'Výsledky kontroly z :lastRanAt',
                'results_refreshed' => 'Výsledky kontroly stavu byly aktualizovány',
            ],
        ],
    ],

];
