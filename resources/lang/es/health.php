<?php

return [

    'all_checks' => 'Todas las comprobaciones',
    'needs_attention' => 'Requieren atención',
    'none_need_attention' => 'Ninguna comprobación requiere atención.',
    'no_results' => 'Todavía no hay resultados.',

    'recent_runs' => 'Últimas :count ejecuciones',
    'latest_run' => 'Última ejecución',
    'saved_run' => 'Ejecución guardada',
    'view_details' => 'Ver detalles',
    'recorded_values' => 'Valores registrados',
    'back_to_latest' => 'Volver a los últimos resultados',
    'run_unavailable' => 'Esta ejecución ya no está disponible.',

    'status_labels' => [
        'ok' => 'Correcta',
        'failed' => 'Fallida',
        'warning' => 'Advertencia',
        'crashed' => 'Error de ejecución',
        'skipped' => 'Omitida',
        'other' => 'Desconocida',
    ],

    'status_groups' => [
        'failed' => 'Fallos',
        'warning' => 'Advertencias',
        'crashed' => 'Comprobaciones interrumpidas',
        'skipped' => 'Comprobaciones omitidas',
    ],

    'status_counts' => [
        'ok' => 'Correctas: :count',
        'other' => 'Otras: :count',
        'failed' => 'Fallidas: :count',
        'crashed' => 'Con error de ejecución: :count',
        'warning' => 'Advertencias: :count',
        'skipped' => 'Omitidas: :count',
    ],

    'pages' => [
        'health_check_results' => [
            'buttons' => [
                'refresh' => 'Refrescar',
            ],

            'heading' => 'Salud de la aplicación',

            'navigation' => [
                'group' => 'Configuración',
                'label' => 'Salud de la aplicación',
            ],

            'notifications' => [
                'check_results' => 'Resultados de verificación de :lastRanAt',
                'results_refreshed' => 'Resultados de verificación de salud actualizados',
            ],
        ],
    ],

];
