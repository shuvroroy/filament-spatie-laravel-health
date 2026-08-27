# Filament Spatie Laravel Health

[![PHP Version Require](https://poser.pugx.org/shuvroroy/filament-spatie-laravel-health/require/php)](https://packagist.org/packages/shuvroroy/filament-spatie-laravel-health)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/shuvroroy/filament-spatie-laravel-health/run-tests.yml?branch=main&label=tests)](https://github.com/shuvroroy/filament-spatie-laravel-health/actions?query=workflow%3Arun-tests+branch%3Amain)
[![Latest Stable Version](https://poser.pugx.org/shuvroroy/filament-spatie-laravel-health/v)](https://packagist.org/packages/shuvroroy/filament-spatie-laravel-health)
[![Total Downloads](https://poser.pugx.org/shuvroroy/filament-spatie-laravel-health/downloads)](https://packagist.org/packages/shuvroroy/filament-spatie-laravel-health)
[![License](https://poser.pugx.org/shuvroroy/filament-spatie-laravel-health/license)](https://packagist.org/packages/shuvroroy/filament-spatie-laravel-health)

This package adds a Filament page for monitoring checks registered with [spatie/laravel-health](https://spatie.be/docs/laravel-health/v1/introduction). It supports Filament 4 and 5 and PHP 8.2 or newer.

<img width="1486" alt="Screenshot 2023-08-04 at 10 06 01 PM" src="https://github.com/shuvroroy/filament-spatie-laravel-health/assets/21066418/fe0b9b55-04ef-4ea9-b89f-bd6e0cf0964a">

## Installation

Install the package via Composer:

```bash
composer require shuvroroy/filament-spatie-laravel-health
```

Laravel Health can store results [in various ways](https://spatie.be/docs/laravel-health/v1/storing-results/general). If you use its default Eloquent result store, publish and run the migration that creates the `health_check_result_history_items` table:

```bash
php artisan vendor:publish --tag="health-migrations"
php artisan migrate
```

Publish Filament's assets:

```bash
php artisan filament:assets
```

## Usage

Register the plugin in your Filament panel provider, such as `AdminPanelProvider`:

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

Register your health checks in the `boot()` method of `app/Providers/AppServiceProvider.php`:

```php
<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Spatie\Health\Facades\Health;
use Spatie\Health\Checks\Checks\DebugModeCheck;
use Spatie\Health\Checks\Checks\EnvironmentCheck;
use Spatie\Health\Checks\Checks\OptimizedAppCheck;

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

See the [available checks](https://spatie.be/docs/laravel-health/v1/available-checks/overview) in the Laravel Health documentation.

## Customising the navigation

The plugin exposes methods for changing the page's navigation group, sort order, icon, and label. Each option also accepts a closure when the value needs to be determined at runtime.

```php
FilamentSpatieLaravelHealthPlugin::make()
    ->navigationGroup('System')
    ->navigationSort(10)
    ->navigationIcon('heroicon-o-cpu-chip')
    ->navigationLabel('Application Health');
```

Pass `null` to `navigationGroup()` to remove the default navigation group. Pass `null` to `navigationLabel()` to use the translated default label.

## Using a custom page

Extend the default page when you need to customise page-specific behavior, such as its heading or view. Configure navigation through the plugin methods described above.

```php
<?php

namespace App\Filament\Pages;

use Illuminate\Contracts\Support\Htmlable;
use ShuvroRoy\FilamentSpatieLaravelHealth\Pages\HealthCheckResults as BaseHealthCheckResults;

class HealthCheckResults extends BaseHealthCheckResults
{
    public function getHeading(): string | Htmlable
    {
        return 'Health Check Results';
    }
}
```

Then pass the custom page class to the plugin in your panel provider:

```php
<?php

namespace App\Providers\Filament;

use App\Filament\Pages\HealthCheckResults;
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
                    ->usingPage(HealthCheckResults::class),
            );
    }
}
```

## Authorising access

The page is accessible by default. Pass a boolean or closure to `authorize()` to restrict access:

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
                    ->authorize(fn (): bool => auth()->user()?->email === 'admin@example.com'),
            );
    }
}
```

## Upgrading

Please see [UPGRADE](UPGRADE.md) for details on how to upgrade 1.X to 2.0.

## Testing

```bash
composer test
composer test:coverage
composer analyse
composer format
```

The coverage command requires Xdebug or PCOV and fails when coverage is below 100%.

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
