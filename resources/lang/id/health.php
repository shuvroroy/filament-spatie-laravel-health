<?php

return [

    'all_checks' => 'Semua pemeriksaan',
    'needs_attention' => 'Perlu perhatian',
    'none_need_attention' => 'Tidak ada pemeriksaan yang memerlukan perhatian.',
    'no_results' => 'Belum ada hasil pemeriksaan.',

    'recent_runs' => ':count pemeriksaan terakhir',
    'latest_run' => 'Pemeriksaan terakhir',
    'saved_run' => 'Pemeriksaan tersimpan',
    'view_details' => 'Lihat detail',
    'recorded_values' => 'Nilai tercatat',
    'back_to_latest' => 'Kembali ke hasil terbaru',
    'run_unavailable' => 'Hasil pemeriksaan ini sudah tidak tersedia.',

    'status_labels' => [
        'ok' => 'Berhasil',
        'failed' => 'Gagal',
        'warning' => 'Peringatan',
        'crashed' => 'Galat eksekusi',
        'skipped' => 'Dilewati',
        'other' => 'Tidak diketahui',
    ],

    'status_groups' => [
        'failed' => 'Kegagalan',
        'warning' => 'Peringatan',
        'crashed' => 'Pemeriksaan terhenti',
        'skipped' => 'Pemeriksaan dilewati',
    ],

    'status_counts' => [
        'ok' => ':count berhasil',
        'other' => ':count lainnya',
        'failed' => ':count gagal',
        'crashed' => ':count mengalami galat',
        'warning' => ':count peringatan',
        'skipped' => ':count dilewati',
    ],

    'pages' => [
        'health_check_results' => [
            'buttons' => [
                'refresh' => 'Segarkan',
                'run_checks' => 'Jalankan pemeriksaan',
            ],

            'heading' => 'Kesehatan Aplikasi',

            'navigation' => [
                'group' => 'Pengaturan',
                'label' => 'Kesehatan Aplikasi',
            ],

            'notifications' => [
                'check_results' => 'Periksa hasil dari :lastRanAt',
                'results_refreshed' => 'Hasil pemeriksaan kesehatan disegarkan',
            ],
        ],
    ],

];
