<?php

return [

    'all_checks' => 'Todas as verificações',
    'needs_attention' => 'Requerem atenção',
    'none_need_attention' => 'Nenhuma verificação requer atenção.',
    'no_results' => 'Ainda não há resultados de verificações.',

    'recent_runs' => 'Últimas :count execuções',
    'latest_run' => 'Última execução',

    'status_labels' => [
        'ok' => 'Bem-sucedida',
        'failed' => 'Falha',
        'warning' => 'Aviso',
        'crashed' => 'Erro de execução',
        'skipped' => 'Ignorada',
        'other' => 'Desconhecido',
    ],

    'status_counts' => [
        'ok' => 'Bem-sucedidas: :count',
        'other' => 'Outras: :count',
        'failed' => 'Falhas: :count',
        'crashed' => 'Erros de execução: :count',
        'warning' => 'Avisos: :count',
        'skipped' => 'Ignoradas: :count',
    ],

    'pages' => [
        'health_check_results' => [
            'buttons' => [
                'refresh' => 'Atualizar',
            ],

            'heading' => 'Saúde da Aplicação',

            'navigation' => [
                'group' => 'Configurações',
                'label' => 'Saúde da Aplicação',
            ],

            'notifications' => [
                'check_results' => 'Última verificação: :lastRanAt',
            ],
        ],
    ],

];
