<?php

return [

    'all_checks' => 'Tất cả kiểm tra',
    'needs_attention' => 'Cần chú ý',
    'none_need_attention' => 'Không có kiểm tra nào cần chú ý.',
    'no_results' => 'Chưa có kết quả kiểm tra.',

    'check_history' => 'Lịch sử gần đây',
    'recent_runs' => ':count lần chạy gần nhất',
    'latest_run' => 'Lần chạy gần nhất',
    'saved_run' => 'Lần chạy đã lưu',
    'view_details' => 'Xem chi tiết',
    'recorded_values' => 'Giá trị đã ghi nhận',
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

    'status_groups' => [
        'failed' => 'Kiểm tra thất bại',
        'warning' => 'Cảnh báo',
        'crashed' => 'Kiểm tra bị lỗi',
        'skipped' => 'Kiểm tra đã bỏ qua',
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
                'run_checks' => 'Chạy kiểm tra',
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
