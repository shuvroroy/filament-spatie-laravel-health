<?php

return [

    'all_checks' => 'ყველა შემოწმება',
    'needs_attention' => 'საჭიროებს ყურადღებას',
    'none_need_attention' => 'არცერთი შემოწმება არ საჭიროებს ყურადღებას.',
    'no_results' => 'შემოწმების შედეგები ჯერ არ არის.',

    'recent_runs' => 'ბოლო :count გაშვება',
    'latest_run' => 'ბოლო გაშვება',
    'saved_run' => 'შენახული გაშვება',
    'view_details' => 'დეტალების ნახვა',
    'recorded_values' => 'ჩაწერილი მნიშვნელობები',
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

    'status_groups' => [
        'failed' => 'წარუმატებელი შემოწმებები',
        'warning' => 'გაფრთხილებები',
        'crashed' => 'შეწყვეტილი შემოწმებები',
        'skipped' => 'გამოტოვებული შემოწმებები',
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
                'run_checks' => 'შემოწმებების გაშვება',
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
