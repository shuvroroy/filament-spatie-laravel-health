<?php

return [

    'all_checks' => 'Alle Prüfungen',
    'needs_attention' => 'Handlungsbedarf',
    'none_need_attention' => 'Keine Prüfung erfordert Aufmerksamkeit.',
    'no_results' => 'Es liegen noch keine Prüfergebnisse vor.',

    'recent_runs' => 'Letzte :count Durchläufe',
    'latest_run' => 'Letzter Durchlauf',
    'saved_run' => 'Gespeicherter Durchlauf',
    'view_details' => 'Details anzeigen',
    'recorded_values' => 'Erfasste Werte',
    'back_to_latest' => 'Zu den aktuellen Ergebnissen',
    'run_unavailable' => 'Dieser Durchlauf ist nicht mehr verfügbar.',

    'status_labels' => [
        'ok' => 'Erfolgreich',
        'failed' => 'Fehlgeschlagen',
        'warning' => 'Warnung',
        'crashed' => 'Abgestürzt',
        'skipped' => 'Übersprungen',
        'other' => 'Unbekannt',
    ],

    'status_groups' => [
        'failed' => 'Fehler',
        'warning' => 'Warnungen',
        'crashed' => 'Abgestürzte Prüfungen',
        'skipped' => 'Übersprungene Prüfungen',
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
