<?php

use Spatie\Health\Enums\Status;

return [
    /*
    |--------------------------------------------------------------------------
    | Navigation Icon
    |--------------------------------------------------------------------------
    |
    | This is the configuration for the Navigation icon
    |
    | use the hero icon library https://heroicons.com/
    | use prefix for apply icon
    | `heroicon-o-` => outline
    | `heroicon-s-` => solid
    | `heroicon-m-` => mini
    */
    'navigation-icon' => 'heroicon-o-heart',

    /*
    |--------------------------------------------------------------------------
    | Pages
    |--------------------------------------------------------------------------
    |
    | This is the configuration for the general appearance of the page
    | in admin panel.
    |
    */

    'pages' => [
        'health' => \ShuvroRoy\FilamentSpatieLaravelHealth\Pages\HealthCheckResults::class
    ],

    /*
    |--------------------------------------------------------------------------
    | Background colors
    |--------------------------------------------------------------------------
    |
    | This is the configuration for the status icon background color
    |
    */

    'background-colors' => [
        Status::ok()->value => 'bg-emerald-100',
        Status::warning()->value => 'bg-yellow-100',
        Status::skipped()->value => 'bg-blue-100',
        Status::failed()->value => 'bg-red-100',
        Status::crashed()->value => 'bg-red-100',
        'default' => 'bg-gray-100',
    ],

    /*
    |--------------------------------------------------------------------------
    | Icon colors
    |--------------------------------------------------------------------------
    |
    | This is the configuration for the status icon color
    |
    */

    'icon-colors' => [
        Status::ok()->value => 'text-emerald-500',
        Status::warning()->value => 'text-yellow-500',
        Status::skipped()->value => 'text-blue-500',
        Status::failed()->value => 'text-red-500',
        Status::crashed()->value => 'text-red-500',
        'default' => 'text-gray-500',
    ],

    /*
    |--------------------------------------------------------------------------
    | Icons
    |--------------------------------------------------------------------------
    |
    | This is the configuration for the status icon
    |
    */

    'icons' => [
        Status::ok()->value => 'heroicon-s-check-circle',
        Status::warning()->value => 'heroicon-s-exclamation-circle',
        Status::skipped()->value => 'heroicon-s-arrow-right-circle',
        Status::failed()->value => 'heroicon-s-x-circle',
        Status::crashed()->value => 'heroicon-s-x-circle',
        'default' => 'heroicon-s-question-mark-circle',
    ],
];
