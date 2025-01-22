# Filament Spatie Laravel Health

[![PHP Version Require](https://poser.pugx.org/shuvroroy/filament-spatie-laravel-health/require/php)](https://packagist.org/packages/shuvroroy/filament-spatie-laravel-health)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/shuvroroy/filament-spatie-laravel-health/run-tests.yml?branch=main&label=tests)](https://github.com/shuvroroy/filament-spatie-laravel-health/actions?query=workflow%3Arun-tests+branch%3Amain)
[![Latest Stable Version](https://poser.pugx.org/shuvroroy/filament-spatie-laravel-health/v)](https://packagist.org/packages/shuvroroy/filament-spatie-laravel-health)
[![Total Downloads](https://poser.pugx.org/shuvroroy/filament-spatie-laravel-health/downloads)](https://packagist.org/packages/shuvroroy/filament-spatie-laravel-health)
[![License](https://poser.pugx.org/shuvroroy/filament-spatie-laravel-health/license)](https://packagist.org/packages/shuvroroy/filament-spatie-laravel-health)

This package provides a Filament page that you can monitor the health of your application by registering checks using the [spatie/laravel-health](https://spatie.be/docs/laravel-health/v1/introduction) package.

<img width="1486" alt="Screenshot 2023-08-04 at 10 06 01 PM" src="https://github.com/shuvroroy/filament-spatie-laravel-health/assets/21066418/fe0b9b55-04ef-4ea9-b89f-bd6e0cf0964a">

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

Publish the package's assets:

```bash
php artisan filament:assets
```

## Usage

You first need to register the plugin with Filament. This can be done inside of your `PanelProvider`, e.g. `AdminPanelProvider`.

 ```php
<?php

namespace App\Providers\Filament;

use Filament\Panel;
use Filament\PanelProvider;
use ShuvroRoy\FilamentSpatieLaravelHealth\FilamentSpatieLaravelHealthPlugin;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            // ...
            ->plugin(FilamentSpatieLaravelHealthPlugin::make());
    }
}
```

Then register Health::checks on app/Providers/AppServiceProvider.php -> `boot` method

 ```php
<?php

namespace App\Providers;

use Spatie\Health\Facades\Health;
use Spatie\Health\Checks\Checks\OptimizedAppCheck;
use Spatie\Health\Checks\Checks\DebugModeCheck;
use Spatie\Health\Checks\Checks\EnvironmentCheck;

class AppServiceProvider extends ServiceProvider
{
     public function boot(): void
     {
         Health::checks([
             OptimizedAppCheck::new(),
             DebugModeCheck::new(),
             EnvironmentCheck::new(),
         ]);
     }
 }
 ```

Read the full documentation on [Spatie Laravel Health](https://spatie.be/docs/laravel-health/v1/available-checks/overview)

If you want to override the default `HealthCheckResults` page icon, heading then you can extend the page class and override the `navigationIcon` property and `getHeading` method and so on.

```php
<?php

namespace App\Filament\Pages;

use ShuvroRoy\FilamentSpatieLaravelHealth\Pages\HealthCheckResults as BaseHealthCheckResults;

class HealthCheckResults extends BaseHealthCheckResults
{
    protected static ?string $navigationIcon = 'heroicon-o-cpu-chip';

    public function getHeading(): string | Htmlable
    {
        return 'Health Check Results';
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Core';
    }
}
```
Then register the extended page class on `AdminPanelProvider` class.

```php
<?php

namespace App\Providers\Filament;

use Filament\Panel;
use Filament\PanelProvider;
use ShuvroRoy\FilamentSpatieLaravelHealth\FilamentSpatieLaravelHealthPlugin;
use App\Filament\Pages\HealthCheckResults;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            // ...
            ->plugin(
                FilamentSpatieLaravelHealthPlugin::make()
                    ->usingPage(HealthCheckResults::class)
            );
    }
}
```

## Customising who can access the page

You can customise who can access the `Hleath` page by adding an `authorize` method to the plugin.
The method should return a boolean indicating whether the user is authorised to access the page.

```php
<?php

namespace App\Providers\Filament;

use Filament\Panel;
use Filament\PanelProvider;
use ShuvroRoy\FilamentSpatieLaravelHealth\FilamentSpatieLaravelHealthPlugin;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            // ...
            ->plugin(
                FilamentSpatieLaravelHealthPlugin::make()
                     ->authorize(fn (): bool => auth()->user()->email === 'admin@example.com'),
            );
    }
}
```

## Upgrading

Please see [UPGRADE](UPGRADE.md) for details on how to upgrade 1.X to 2.0.

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
