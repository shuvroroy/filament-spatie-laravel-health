<?php

return [

    'all_checks' => 'Усі перевірки',
    'needs_attention' => 'Потребують уваги',
    'none_need_attention' => 'Жодна перевірка не потребує уваги.',
    'no_results' => 'Результатів перевірок поки немає.',

    'check_history' => 'Останні результати',
    'recent_runs' => 'Останні запуски (:count)',
    'latest_run' => 'Останній запуск',
    'saved_run' => 'Збережений запуск',
    'view_details' => 'Переглянути подробиці',
    'recorded_values' => 'Записані значення',
    'back_to_latest' => 'До останніх результатів',
    'run_unavailable' => 'Цей запуск більше недоступний.',

    'status_labels' => [
        'ok' => 'Пройдено',
        'failed' => 'Не пройдено',
        'warning' => 'Попередження',
        'crashed' => 'Збій',
        'skipped' => 'Пропущено',
        'other' => 'Невідомо',
    ],

    'status_groups' => [
        'failed' => 'Помилки',
        'warning' => 'Попередження',
        'crashed' => 'Аварійно завершені перевірки',
        'skipped' => 'Пропущені перевірки',
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
                'run_checks' => 'Запустити перевірки',
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
