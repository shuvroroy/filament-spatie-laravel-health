<?php

return [

    'all_checks' => 'Tutte le verifiche',
    'needs_attention' => 'Richiedono attenzione',
    'none_need_attention' => 'Nessuna verifica richiede attenzione.',
    'no_results' => 'Nessun risultato ancora disponibile.',

    'recent_runs' => 'Ultime :count esecuzioni',
    'latest_run' => 'Ultima esecuzione',

    'status_labels' => [
        'ok' => 'Superata',
        'failed' => 'Fallita',
        'warning' => 'Avviso',
        'crashed' => 'Errore di esecuzione',
        'skipped' => 'Saltata',
        'other' => 'Sconosciuto',
    ],

    'status_counts' => [
        'ok' => 'Superate: :count',
        'other' => 'Altre: :count',
        'failed' => 'Fallite: :count',
        'crashed' => 'Errori di esecuzione: :count',
        'warning' => 'Avvisi: :count',
        'skipped' => 'Saltate: :count',
    ],

    'pages' => [
        'health_check_results' => [
            'buttons' => [
                'refresh' => 'Aggiorna',
            ],

            'heading' => "Salute dell'Applicazione",

            'navigation' => [
                'group' => 'Impostazioni',
                'label' => "Salute dell'Applicazione",
            ],

            'notifications' => [
                'check_results' => 'Ultima verifica :lastRanAt',
                'results_refreshed' => 'Risultati Health Check aggiornati',
            ],
        ],
    ],

];
