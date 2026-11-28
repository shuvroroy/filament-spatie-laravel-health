<?php

return [

    'all_checks' => 'すべてのチェック',
    'needs_attention' => '要確認',
    'none_need_attention' => '確認が必要なチェックはありません。',
    'no_results' => 'チェック結果はまだありません。',

    'recent_runs' => '直近 :count 回',
    'latest_run' => '直近の実行',
    'saved_run' => '保存された実行結果',
    'view_details' => '詳細を表示',
    'recorded_values' => '記録された値',
    'back_to_latest' => '最新の結果に戻る',
    'run_unavailable' => 'この実行結果は利用できなくなりました。',

    'status_labels' => [
        'ok' => '正常',
        'failed' => '失敗',
        'warning' => '警告',
        'crashed' => '異常終了',
        'skipped' => 'スキップ',
        'other' => '不明',
    ],

    'status_groups' => [
        'failed' => '失敗',
        'warning' => '警告',
        'crashed' => '異常終了したチェック',
        'skipped' => 'スキップされたチェック',
    ],

    'status_counts' => [
        'ok' => '正常 :count 件',
        'other' => 'その他 :count 件',
        'failed' => '失敗 :count 件',
        'crashed' => '異常終了 :count 件',
        'warning' => '警告 :count 件',
        'skipped' => 'スキップ :count 件',
    ],

    'pages' => [
        'health_check_results' => [
            'buttons' => [
                'refresh' => '更新',
                'run_checks' => 'チェックを実行',
            ],

            'heading' => 'アプリケーションの健康状態',

            'navigation' => [
                'group' => '設定',
                'label' => 'アプリケーションの健康状態',
            ],

            'notifications' => [
                'check_results' => '最終チェック：:lastRanAt',
            ],
        ],
    ],

];
