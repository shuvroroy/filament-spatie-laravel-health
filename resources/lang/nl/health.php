<?php

return [

    'all_checks' => 'Alle controles',
    'needs_attention' => 'Aandacht nodig',
    'none_need_attention' => 'Geen enkele controle vereist aandacht.',
    'no_results' => 'Er zijn nog geen controleresultaten.',

    'recent_runs' => 'Laatste :count uitvoeringen',
    'latest_run' => 'Laatste uitvoering',

    'status_labels' => [
        'ok' => 'Geslaagd',
        'failed' => 'Mislukt',
        'warning' => 'Waarschuwing',
        'crashed' => 'Gecrasht',
        'skipped' => 'Overgeslagen',
        'other' => 'Onbekend',
    ],

    'status_counts' => [
        'ok' => ':count geslaagd',
        'other' => 'Overig: :count',
        'failed' => ':count mislukt',
        'crashed' => ':count gecrasht',
        'warning' => ':count waarschuwing|:count waarschuwingen',
        'skipped' => ':count overgeslagen',
    ],

    'pages' => [
        'health_check_results' => [
            'buttons' => [
                'refresh' => 'Vernieuwen',
            ],

            'heading' => 'Gezondheid van de applicatie',

            'navigation' => [
                'group' => 'Instellingen',
                'label' => 'Gezondheid van de applicatie',
            ],

            'notifications' => [
                'check_results' => 'Gezondheidschecks resultaten van :lastRanAt',
                'results_refreshed' => 'Gezondheidschecks resultaten zijn vernieuwd',
            ],
        ],
    ],

];
