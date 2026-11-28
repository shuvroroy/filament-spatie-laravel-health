<?php

return [

    'all_checks' => 'Tüm kontroller',
    'needs_attention' => 'İlgilenilmesi gerekenler',
    'none_need_attention' => 'İlgilenilmesi gereken kontrol yok.',
    'no_results' => 'Henüz kontrol sonucu yok.',

    'recent_runs' => 'Son :count çalıştırma',
    'latest_run' => 'Son çalıştırma',

    'status_labels' => [
        'ok' => 'Başarılı',
        'failed' => 'Başarısız',
        'warning' => 'Uyarı',
        'crashed' => 'Çalıştırma hatası',
        'skipped' => 'Atlandı',
        'other' => 'Bilinmiyor',
    ],

    'status_counts' => [
        'ok' => ':count başarılı',
        'other' => 'Diğer: :count',
        'failed' => ':count başarısız',
        'crashed' => ':count çalıştırma hatası',
        'warning' => ':count uyarı',
        'skipped' => ':count atlandı',
    ],

    'pages' => [
        'health_check_results' => [
            'buttons' => [
                'refresh' => 'Yenile',
            ],

            'heading' => 'Uygulama Sağlığı',

            'navigation' => [
                'group' => 'Ayarlar',
                'label' => 'Uygulama Sağlığı',
            ],

            'notifications' => [
                'check_results' => 'Son kontrol: :lastRanAt',
            ],
        ],
    ],

];
