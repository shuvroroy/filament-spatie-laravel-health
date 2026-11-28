<?php

return [

    'all_checks' => 'Alle controles',
    'needs_attention' => 'Aandacht nodig',
    'none_need_attention' => 'Geen enkele controle vereist aandacht.',
    'no_results' => 'Er zijn nog geen controleresultaten.',

    'recent_runs' => 'Laatste :count uitvoeringen',
    'latest_run' => 'Laatste uitvoering',
    'saved_run' => 'Opgeslagen controle',
    'view_details' => 'Details bekijken',
    'recorded_values' => 'Vastgelegde waarden',
    'back_to_latest' => 'Terug naar de laatste resultaten',
    'run_unavailable' => 'Deze controle is niet meer beschikbaar.',

    'status_labels' => [
        'ok' => 'Geslaagd',
        'failed' => 'Mislukt',
        'warning' => 'Waarschuwing',
        'crashed' => 'Gecrasht',
        'skipped' => 'Overgeslagen',
        'other' => 'Onbekend',
    ],

    'status_groups' => [
        'failed' => 'Mislukte controles',
        'warning' => 'Waarschuwingen',
        'crashed' => 'Gecrashte controles',
        'skipped' => 'Overgeslagen controles',
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
