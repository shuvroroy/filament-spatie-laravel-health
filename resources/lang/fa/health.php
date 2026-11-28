<?php

return [

    'all_checks' => 'همهٔ بررسی‌ها',
    'needs_attention' => 'نیازمند توجه',
    'none_need_attention' => 'هیچ بررسی‌ای به توجه نیاز ندارد.',
    'no_results' => 'هنوز نتیجه‌ای برای بررسی‌ها ثبت نشده است.',

    'recent_runs' => ':count اجرای اخیر',
    'latest_run' => 'آخرین اجرا',
    'saved_run' => 'اجرای ذخیره‌شده',
    'view_details' => 'مشاهده جزئیات',
    'recorded_values' => 'مقادیر ثبت‌شده',
    'back_to_latest' => 'بازگشت به آخرین نتایج',
    'run_unavailable' => 'این اجرا دیگر در دسترس نیست.',

    'status_labels' => [
        'ok' => 'موفق',
        'failed' => 'ناموفق',
        'warning' => 'هشدار',
        'crashed' => 'خطای اجرا',
        'skipped' => 'ردشده',
        'other' => 'نامشخص',
    ],

    'status_groups' => [
        'failed' => 'خطاها',
        'warning' => 'هشدارها',
        'crashed' => 'بررسی‌های متوقف‌شده',
        'skipped' => 'بررسی‌های ردشده',
    ],

    'status_counts' => [
        'ok' => 'موفق: :count',
        'other' => 'سایر: :count',
        'failed' => 'ناموفق: :count',
        'crashed' => 'خطای اجرا: :count',
        'warning' => 'هشدار: :count',
        'skipped' => 'ردشده: :count',
    ],

    'pages' => [
        'health_check_results' => [
            'buttons' => [
                'refresh' => 'بروز‌رسانی',
            ],

            'heading' => 'سلامت‌برنامه',

            'navigation' => [
                'group' => 'تنظیمات',
                'label' => 'سلامت‌برنامه',
            ],

            'notifications' => [
                'check_results' => 'آخرین بررسی: :lastRanAt',
            ],
        ],
    ],

];
