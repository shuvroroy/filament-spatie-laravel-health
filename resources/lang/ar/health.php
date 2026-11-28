<?php

return [

    'all_checks' => 'كل الفحوصات',
    'needs_attention' => 'تحتاج إلى انتباه',
    'none_need_attention' => 'لا توجد فحوصات تحتاج إلى انتباه.',
    'no_results' => 'لا توجد نتائج فحوصات حتى الآن.',

    'recent_runs' => 'آخر :count عمليات فحص',
    'latest_run' => 'آخر عملية فحص',
    'saved_run' => 'تشغيل محفوظ',
    'view_details' => 'عرض التفاصيل',
    'recorded_values' => 'القيم المسجّلة',
    'back_to_latest' => 'العودة إلى أحدث النتائج',
    'run_unavailable' => 'لم يعد هذا التشغيل متاحًا.',

    'status_labels' => [
        'ok' => 'ناجح',
        'failed' => 'فشل',
        'warning' => 'تحذير',
        'crashed' => 'تعطّل',
        'skipped' => 'تم تخطيه',
        'other' => 'غير معروف',
    ],

    'status_groups' => [
        'failed' => 'حالات الفشل',
        'warning' => 'التحذيرات',
        'crashed' => 'الفحوصات المتعطلة',
        'skipped' => 'الفحوصات المتخطاة',
    ],

    'status_counts' => [
        'ok' => 'ناجحة: :count',
        'other' => 'أخرى: :count',
        'failed' => 'فشل: :count',
        'crashed' => 'تعطّل: :count',
        'warning' => 'تحذيرات: :count',
        'skipped' => 'تم تخطيها: :count',
    ],

    'pages' => [
        'health_check_results' => [
            'buttons' => [
                'refresh' => 'تحديث',
                'run_checks' => 'تشغيل الفحوصات',
            ],

            'heading' => 'حالة النظام',

            'navigation' => [
                'group' => 'إعدادات',
                'label' => 'حالة النظام',
            ],

            'notifications' => [
                'check_results' => 'آخر فحص: :lastRanAt',
            ],
        ],
    ],

];
