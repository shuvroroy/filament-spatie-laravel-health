<?php

return [

    'all_checks' => 'ყველა შემოწმება',
    'needs_attention' => 'საჭიროებს ყურადღებას',
    'none_need_attention' => 'არცერთი შემოწმება არ საჭიროებს ყურადღებას.',
    'no_results' => 'შემოწმების შედეგები ჯერ არ არის.',

    'recent_runs' => 'ბოლო :count გაშვება',
    'latest_run' => 'ბოლო გაშვება',
    'saved_run' => 'შენახული გაშვება',
    'back_to_latest' => 'ბოლო შედეგებზე დაბრუნება',
    'run_unavailable' => 'ეს გაშვება აღარ არის ხელმისაწვდომი.',

    'status_labels' => [
        'ok' => 'წარმატებული',
        'failed' => 'წარუმატებელი',
        'warning' => 'გაფრთხილება',
        'crashed' => 'შესრულების შეცდომა',
        'skipped' => 'გამოტოვებული',
        'other' => 'უცნობი',
    ],

    'status_counts' => [
        'ok' => 'წარმატებული: :count',
        'other' => 'სხვა: :count',
        'failed' => 'წარუმატებელი: :count',
        'crashed' => 'შესრულების შეცდომა: :count',
        'warning' => 'გაფრთხილება: :count',
        'skipped' => 'გამოტოვებული: :count',
    ],

    'pages' => [
        'health_check_results' => [
            'buttons' => [
                'refresh' => 'განახლება',
            ],

            'heading' => 'აპლიკაციის სტატუსი',

            'navigation' => [
                'group' => 'პარამეტრები',
                'label' => 'სერვერის ჯანმრთელობა',
            ],

            'notifications' => [
                'check_results' => 'ბოლოს შემოწმდა: :lastRanAt',
            ],
        ],
    ],

];
