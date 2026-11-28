<?php

return [

    'all_checks' => 'Alle Prüfungen',
    'needs_attention' => 'Handlungsbedarf',
    'none_need_attention' => 'Keine Prüfung erfordert Aufmerksamkeit.',
    'no_results' => 'Es liegen noch keine Prüfergebnisse vor.',

    'recent_runs' => 'Letzte :count Durchläufe',
    'latest_run' => 'Letzter Durchlauf',

    'status_labels' => [
        'ok' => 'Erfolgreich',
        'failed' => 'Fehlgeschlagen',
        'warning' => 'Warnung',
        'crashed' => 'Abgestürzt',
        'skipped' => 'Übersprungen',
        'other' => 'Unbekannt',
    ],

    'status_counts' => [
        'ok' => ':count erfolgreich',
        'other' => 'Sonstige: :count',
        'failed' => ':count fehlgeschlagen',
        'crashed' => ':count abgestürzt',
        'warning' => ':count Warnung|:count Warnungen',
        'skipped' => ':count übersprungen',
    ],

    'pages' => [
        'health_check_results' => [
            'buttons' => [
                'refresh' => 'Aktualisieren',
            ],

            'heading' => 'Anwendungsgesundheit',

            'navigation' => [
                'group' => 'Einstellungen',
                'label' => 'Anwendungsgesundheit',
            ],

            'notifications' => [
                'check_results' => 'Geprüft: :lastRanAt',
                'results_refreshed' => 'Prüfergebnisse wurden aktualisiert',
            ],
        ],
    ],

];
