# Upgrade Guide

## Upgrading from v1.x to v2.0

Starting with version v2.0, this package now only supports Filament v3.x.

Follow these steps to update the package for Filament v3.x.

1. Update the package version in your `composer.json`.
2. Run `composer update`.
3. Register the plugin inside of your project's `PanelProvider`, e.g. `AdminPanelProvider`.

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

4. Publish the plugin assets.

```sh
php artisan filament:assets
```

5. If you previously used the configuration file to change the `health` value, those no longer exist and need to be updated to method calls on the plugin object.

```php
<?php

namespace App\Providers\Filament;

use Filament\Panel;
use Filament\PanelProvider;
use App\Filament\Pages\HealthCheckResults;
use ShuvroRoy\FilamentSpatieLaravelHealth\FilamentSpatieLaravelHealthPlugin;

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

If you have any issues with the upgrade, please open an issue and provide details. Reproduction repositories are much appreciated.
