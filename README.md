# Filament Spatie Laravel Health

[![Latest Version on Packagist](https://img.shields.io/packagist/v/shuvroroy/filament-spatie-laravel-health.svg?style=flat-square)](https://packagist.org/packages/shuvroroy/filament-spatie-laravel-health)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/shuvroroy/filament-spatie-laravel-health/run-tests?label=tests)](https://github.com/shuvroroy/filament-spatie-laravel-health/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/shuvroroy/filament-spatie-laravel-health/Check%20&%20fix%20styling?label=code%20style)](https://github.com/shuvroroy/filament-spatie-laravel-health/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/shuvroroy/filament-spatie-laravel-health.svg?style=flat-square)](https://packagist.org/packages/shuvroroy/filament-spatie-laravel-health)

This package provides a Filament page that you can monitor the health of your application by registering checks using the [spatie/laravel-health](https://spatie.be/docs/laravel-health/v1/introduction) package.

![Health Check Results - Filament Demo](https://user-images.githubusercontent.com/21066418/147746698-8a21ab58-1771-4525-9595-0bbcedc6a325.png)

## Installation

You can install the package via composer:

```bash
composer require shuvroroy/filament-spatie-laravel-health
```

This package can store health check results [in various ways](https://spatie.be/docs/laravel-health/v1/storing-results/general). When using the EloquentHealthResultStore the check results will be stored in the database. To create the health_check_result_history_items table, you must create and run the migration.

```bash
php artisan vendor:publish --tag="health-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="filament-spatie-health-config"
```

This is the contents of the published config file:

```php
return [

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
```

Use the hero icon library https://heroicons.com/

Use prefix for apply icon
- `heroicon-o-`: outline
- `heroicon-s-`: solid
- `heroicon-m-`: mini

Examples: 
- heroicon-s-**check-circle** ![](https://api.iconify.design/material-symbols/check-circle-outline.svg)
- heroicon-o-**check-circle** ![](https://api.iconify.design/heroicons/check-circle-solid.svg)

## Usage

This package will automatically register the `HealthCheckResults`. You'll be able to see it when you visit your Filament admin panel.

## Defining Resources to health check

Register Health::checks on app/Providers/AppServiceProvider.php -> `boot` method

```php
<?php

namespace App\Providers;

...
...
use Spatie\Health\Facades\Health;
use Spatie\Health\Checks\Checks\OptimizedAppCheck;
use Spatie\Health\Checks\Checks\DebugModeCheck;
use Spatie\Health\Checks\Checks\EnvironmentCheck;

class AppServiceProvider extends ServiceProvider
{
    ...

    public function boot()
    {
        ...
    
        Health::checks([
            OptimizedAppCheck::new(),
            DebugModeCheck::new(),
            EnvironmentCheck::new(),
            ...
            ...
        ]);
    }
}
```

Read the full documentation on [Spatie Laravel Health](https://spatie.be/docs/laravel-health/v1/available-checks/overview)

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Shuvro Roy](https://github.com/shuvroroy)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
