# Filament Spatie Laravel Health

[![PHP Version Require](https://poser.pugx.org/shuvroroy/filament-spatie-laravel-health/require/php)](https://packagist.org/packages/shuvroroy/filament-spatie-laravel-health)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/shuvroroy/filament-spatie-laravel-health/run-tests.yml?branch=main&label=tests)](https://github.com/shuvroroy/filament-spatie-laravel-health/actions?query=workflow%3Arun-tests+branch%3Amain)
[![Latest Stable Version](https://poser.pugx.org/shuvroroy/filament-spatie-laravel-health/v)](https://packagist.org/packages/shuvroroy/filament-spatie-laravel-health)
[![Total Downloads](https://poser.pugx.org/shuvroroy/filament-spatie-laravel-health/downloads)](https://packagist.org/packages/shuvroroy/filament-spatie-laravel-health)
[![License](https://poser.pugx.org/shuvroroy/filament-spatie-laravel-health/license)](https://packagist.org/packages/shuvroroy/filament-spatie-laravel-health)

This package adds a Filament page for monitoring checks registered with [spatie/laravel-health](https://spatie.be/docs/laravel-health/v1/introduction). It supports Filament 4 and 5 and PHP 8.2 or newer. CI tests PHP 8.6 with Laravel 13.

| Light mode | Dark mode |
| --- | --- |
| ![Light results page with eight health checks and a View details action on each card](art/results-light.png) | ![Dark results page showing the same three failures, two warnings, and three passing checks](art/results-dark.png) |

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

After registering the plugin, publish the panel assets:

```bash
php artisan filament:assets
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

## Viewing results

Open **Application Health** in the panel to see the latest stored results. Select **Needs attention** to show warnings, failures, and crashed checks. Skipped checks also appear when Spatie's `health.treat_skipped_as_failure` setting is enabled (the default). The filtered URL can be bookmarked or shared with another authorized user.

Select **Run checks** to execute the registered checks and update their results, or run `php artisan health:check`. Opening the page and switching filters read the stored results.

### Check details

Cards show **View details** when a message is truncated, a check has an additional summary, or it has metadata configured for display. The slide-over shows the full message and recorded values from the run you opened. Close it to return to the same run and filter.

| Light mode | Dark mode |
| --- | --- |
| ![Disk space slide-over with a warning, 86 percent disk usage, and 14 GB available](art/details-light.png) | ![The same disk warning and recorded values in dark mode](art/details-dark.png) |

To display metadata, call `checkMetadata()` in your panel provider. Use the check's stored name as the outer key. For example, a check registered with `->name('Disk')` can expose its disk usage as follows.

```php
FilamentSpatieLaravelHealthPlugin::make()
    ->checkMetadata([
        'Disk' => ['disk_space_used_percentage' => 'Disk used (%)'],
    ]);
```

Each field maps a top-level metadata key to its display label. Only configured fields with a non-empty string, number, or boolean value are shown.

## Optional dashboard widget

Enable the widget in the panel provider for each dashboard where you want it:

```php
$panel->plugin(FilamentSpatieLaravelHealthPlugin::make()->dashboardWidget());
```

| Light mode | Dark mode |
| --- | --- |
| ![Light dashboard widget with three failures collapsed and two warnings expanded](art/widget-light.png) | ![Dark dashboard widget with the disk and backup warning messages visible beneath the run chart](art/widget-dark.png) |

The widget reads saved results every minute while visible. It lists affected checks by severity, starting with crashed and failed checks. A single check shows its message inline. When several checks share a status, the header shows the total and previews up to three names. Expand it to see the full list and each check's message preview.

Select **All checks** in the widget header to open the full list. When checks need attention, select **Needs attention** beside the chart to open the filtered results.

With Spatie's Eloquent store active and at least two recorded runs, the chart shows how many checks needed attention in each of the last 12 runs, oldest first. With one run or a latest-only store, it shows the latest status breakdown.

Hover or focus a bar to see its run time and affected count. Select the bar to open that saved run with **Needs attention** selected. Switch to **All checks** to inspect the other results from the same run, or share the URL. **Back to latest** opens the current results. If retention has removed a run, its link shows an unavailable message.

The widget checks the plugin's `authorize()` callback and the configured results page's `canAccess()` method before reading health results. If your custom page restricts access through route middleware, apply the same policy through `authorize()` before enabling the widget. The widget runs on the dashboard route, where the results page's middleware does not run.

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

### Restricting who can run checks

By default, users with access to the results page can run checks. Use `authorizeRunChecks()` in your panel provider to give operators that permission while other viewers can still inspect and share results. This example uses two abilities defined by your application.

```php
use Illuminate\Support\Facades\Gate;

FilamentSpatieLaravelHealthPlugin::make()
    ->authorize(fn (): bool => Gate::allows('viewHealth'))
    ->authorizeRunChecks(fn (): bool => Gate::allows('runHealthChecks'));
```

Pass `false` to `authorizeRunChecks()` for a read-only panel. The setting applies to manual runs from Filament. Scheduled checks and the Artisan command continue to use your existing configuration.

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
