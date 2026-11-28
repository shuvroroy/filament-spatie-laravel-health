<?php

return [

    'all_checks' => 'Todas as verificações',
    'needs_attention' => 'Precisam de atenção',
    'none_need_attention' => 'Nenhuma verificação precisa de atenção.',
    'no_results' => 'Ainda não há resultados de verificações.',

    'recent_runs' => 'Últimas :count execuções',
    'latest_run' => 'Última execução',
    'saved_run' => 'Execução salva',
    'back_to_latest' => 'Voltar aos resultados mais recentes',
    'run_unavailable' => 'Esta execução não está mais disponível.',

    'status_labels' => [
        'ok' => 'Aprovada',
        'failed' => 'Falha',
        'warning' => 'Aviso',
        'crashed' => 'Erro de execução',
        'skipped' => 'Ignorada',
        'other' => 'Desconhecido',
    ],

    'status_counts' => [
        'ok' => 'Aprovadas: :count',
        'other' => 'Outras: :count',
        'failed' => 'Falhas: :count',
        'crashed' => 'Erros de execução: :count',
        'warning' => 'Avisos: :count',
        'skipped' => 'Ignoradas: :count',
    ],

    'pages' => [
        'health_check_results' => [
            'buttons' => [
                'refresh' => 'Recarregar',
            ],

            'heading' => 'Saúde da aplicação',

            'navigation' => [
                'group' => 'Configurações',
                'label' => 'Saúde da aplicação',
            ],

            'notifications' => [
                'check_results' => 'Última verificação: :lastRanAt',
                'results_refreshed' => 'Resultados da verificação de saúde atualizados',
            ],
        ],
    ],

];
