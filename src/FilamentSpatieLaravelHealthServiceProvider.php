<?php

namespace ShuvroRoy\FilamentSpatieLaravelHealth;

use Filament\PluginServiceProvider;
use Spatie\LaravelPackageTools\Package;

class FilamentSpatieLaravelHealthServiceProvider extends PluginServiceProvider
{
    public static string $name = 'filament-spatie-health';

    public function configurePackage(Package $package): void
    {
        parent::configurePackage($package);

        $package->hasConfigFile('filament-spatie-laravel-health');
    }

    protected function getPages(): array
    {
        return config('filament-spatie-laravel-health.pages');
    }

    protected function getStyles(): array
    {
        return [
            self::$name . '-styles' => __DIR__ . '/../dist/app.css',
        ];
    }
}
