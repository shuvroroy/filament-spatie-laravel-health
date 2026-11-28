<?php

return [

    'all_checks' => 'Todas as verificações',
    'needs_attention' => 'Requerem atenção',
    'none_need_attention' => 'Nenhuma verificação requer atenção.',
    'no_results' => 'Ainda não há resultados de verificações.',

    'recent_runs' => 'Últimas :count execuções',
    'latest_run' => 'Última execução',
    'saved_run' => 'Execução guardada',
    'view_details' => 'Ver detalhes',
    'recorded_values' => 'Valores registados',
    'back_to_latest' => 'Voltar aos resultados mais recentes',
    'run_unavailable' => 'Esta execução já não está disponível.',

    'status_labels' => [
        'ok' => 'Bem-sucedida',
        'failed' => 'Falha',
        'warning' => 'Aviso',
        'crashed' => 'Erro de execução',
        'skipped' => 'Ignorada',
        'other' => 'Desconhecido',
    ],

    'status_groups' => [
        'failed' => 'Falhas',
        'warning' => 'Avisos',
        'crashed' => 'Verificações interrompidas',
        'skipped' => 'Verificações ignoradas',
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
