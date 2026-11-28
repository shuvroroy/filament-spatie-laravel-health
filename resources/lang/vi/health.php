<?php

return [

    'all_checks' => 'Tất cả kiểm tra',
    'needs_attention' => 'Cần chú ý',
    'none_need_attention' => 'Không có kiểm tra nào cần chú ý.',
    'no_results' => 'Chưa có kết quả kiểm tra.',

    'recent_runs' => ':count lần chạy gần nhất',
    'latest_run' => 'Lần chạy gần nhất',
    'saved_run' => 'Lần chạy đã lưu',
    'back_to_latest' => 'Quay lại kết quả mới nhất',
    'run_unavailable' => 'Lần chạy này không còn khả dụng.',

    'status_labels' => [
        'ok' => 'Thành công',
        'failed' => 'Thất bại',
        'warning' => 'Cảnh báo',
        'crashed' => 'Lỗi thực thi',
        'skipped' => 'Bỏ qua',
        'other' => 'Không rõ',
    ],

    'status_counts' => [
        'ok' => ':count thành công',
        'other' => ':count khác',
        'failed' => ':count thất bại',
        'crashed' => ':count lỗi thực thi',
        'warning' => ':count cảnh báo',
        'skipped' => ':count bị bỏ qua',
    ],

    'pages' => [
        'health_check_results' => [
            'buttons' => [
                'refresh' => 'Làm mới',
            ],

            'heading' => 'Tình trạng ứng dụng',

            'navigation' => [
                'group' => 'Cài đặt',
                'label' => 'Tình trạng ứng dụng',
            ],

            'notifications' => [
                'check_results' => 'Lần kiểm tra gần nhất: :lastRanAt',
            ],
        ],
    ],

];
