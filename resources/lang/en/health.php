<?php

return [

    'all_checks' => 'All checks',
    'needs_attention' => 'Needs attention',
    'none_need_attention' => 'No checks need attention.',
    'no_results' => 'No check results available yet.',

    'recent_runs' => 'Last :count runs',
    'latest_run' => 'Latest run',
    'saved_run' => 'Saved run',
    'view_details' => 'View details',
    'recorded_values' => 'Recorded values',
    'back_to_latest' => 'Back to latest',
    'run_unavailable' => 'This run is no longer available.',

    'status_labels' => [
        'ok' => 'Passing',
        'failed' => 'Failed',
        'warning' => 'Warning',
        'crashed' => 'Crashed',
        'skipped' => 'Skipped',
        'other' => 'Unknown',
    ],

    'status_groups' => [
        'failed' => 'Failures',
        'warning' => 'Warnings',
        'crashed' => 'Crashed checks',
        'skipped' => 'Skipped checks',
    ],

    'status_counts' => [
        'ok' => ':count passing',
        'other' => ':count other',
        'failed' => ':count failed',
        'crashed' => ':count crashed',
        'warning' => ':count warning|:count warnings',
        'skipped' => ':count skipped',
    ],

    'pages' => [
        'health_check_results' => [
            'buttons' => [
                'refresh' => 'Refresh',
            ],

            'heading' => 'Application Health',

            'navigation' => [
                'group' => 'Settings',
                'label' => 'Application Health',
            ],

            'notifications' => [
                'check_results' => 'Check results from :lastRanAt',
                'results_refreshed' => 'Health check results refreshed',
            ],
        ],
    ],

];
