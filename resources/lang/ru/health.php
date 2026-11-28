<?php

return [

    'all_checks' => 'Все проверки',
    'needs_attention' => 'Требуют внимания',
    'none_need_attention' => 'Ни одна проверка не требует внимания.',
    'no_results' => 'Результатов проверок пока нет.',

    'recent_runs' => 'Последние запуски (:count)',
    'latest_run' => 'Последний запуск',
    'saved_run' => 'Сохранённый запуск',
    'view_details' => 'Подробнее',
    'recorded_values' => 'Записанные значения',
    'back_to_latest' => 'К последним результатам',
    'run_unavailable' => 'Этот запуск больше недоступен.',

    'status_labels' => [
        'ok' => 'Пройдено',
        'failed' => 'Не пройдено',
        'warning' => 'Предупреждение',
        'crashed' => 'Сбой',
        'skipped' => 'Пропущено',
        'other' => 'Неизвестно',
    ],

    'status_groups' => [
        'failed' => 'Ошибки',
        'warning' => 'Предупреждения',
        'crashed' => 'Аварийно завершённые проверки',
        'skipped' => 'Пропущенные проверки',
    ],

    'status_counts' => [
        'ok' => 'Пройдено: :count',
        'other' => 'Прочие: :count',
        'failed' => 'Не пройдено: :count',
        'crashed' => 'Аварийно завершено: :count',
        'warning' => 'Предупреждений: :count',
        'skipped' => 'Пропущено: :count',
    ],

    'pages' => [
        'health_check_results' => [
            'buttons' => [
                'refresh' => 'Обновить',
                'run_checks' => 'Запустить проверки',
            ],

            'heading' => 'Состояние приложения',

            'navigation' => [
                'group' => 'Настройки',
                'label' => 'Состояние приложения',
            ],

            'notifications' => [
                'check_results' => 'Результаты проверки от :lastRanAt',
                'results_refreshed' => 'Результаты проверки обновлены',
            ],
        ],
    ],

];
