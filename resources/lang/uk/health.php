<?php

return [

    'all_checks' => 'Усі перевірки',
    'needs_attention' => 'Потребують уваги',
    'none_need_attention' => 'Жодна перевірка не потребує уваги.',
    'no_results' => 'Результатів перевірок поки немає.',

    'recent_runs' => 'Останні запуски (:count)',
    'latest_run' => 'Останній запуск',

    'status_labels' => [
        'ok' => 'Пройдено',
        'failed' => 'Не пройдено',
        'warning' => 'Попередження',
        'crashed' => 'Збій',
        'skipped' => 'Пропущено',
        'other' => 'Невідомо',
    ],

    'status_counts' => [
        'ok' => 'Пройдено: :count',
        'other' => 'Інші: :count',
        'failed' => 'Не пройдено: :count',
        'crashed' => 'Аварійно завершено: :count',
        'warning' => 'Попереджень: :count',
        'skipped' => 'Пропущено: :count',
    ],

    'pages' => [
        'health_check_results' => [
            'buttons' => [
                'refresh' => 'Оновити',
            ],

            'heading' => 'Стан застосунку',

            'navigation' => [
                'group' => 'Налаштування',
                'label' => 'Стан застосунку',
            ],

            'notifications' => [
                'check_results' => 'Результати перевірки, виконаної :lastRanAt',
                'results_refreshed' => 'Результати перевірки оновлено',
            ],
        ],
    ],

];
