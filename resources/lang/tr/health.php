<?php

return [

    'all_checks' => 'Tüm kontroller',
    'needs_attention' => 'İlgilenilmesi gerekenler',
    'none_need_attention' => 'İlgilenilmesi gereken kontrol yok.',
    'no_results' => 'Henüz kontrol sonucu yok.',

    'recent_runs' => 'Son :count çalıştırma',
    'latest_run' => 'Son çalıştırma',
    'saved_run' => 'Kaydedilmiş çalıştırma',
    'view_details' => 'Ayrıntıları görüntüle',
    'recorded_values' => 'Kaydedilen değerler',
    'back_to_latest' => 'Son sonuçlara dön',
    'run_unavailable' => 'Bu çalıştırma artık kullanılamıyor.',

    'status_labels' => [
        'ok' => 'Başarılı',
        'failed' => 'Başarısız',
        'warning' => 'Uyarı',
        'crashed' => 'Çalıştırma hatası',
        'skipped' => 'Atlandı',
        'other' => 'Bilinmiyor',
    ],

    'status_groups' => [
        'failed' => 'Başarısız kontroller',
        'warning' => 'Uyarılar',
        'crashed' => 'Çöken kontroller',
        'skipped' => 'Atlanan kontroller',
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
