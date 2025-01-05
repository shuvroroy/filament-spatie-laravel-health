<?php

return [

    'navigation' => [
        'group' => 'Settings',
        'label' => 'Application Health',
    ],

    'pages' => [
        'health_check_results' => [
            'buttons' => [
                'refresh' => 'Refresh',
            ],

            'heading' => 'Application Health',

            'notifications' => [
                'check_results' => 'Check results from :lastRanAt',
                'results_refreshed' => 'Health check results refreshed',
            ],
        ],
    ],

];
