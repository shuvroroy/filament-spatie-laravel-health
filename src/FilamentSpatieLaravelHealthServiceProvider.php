<?php

namespace ShuvroRoy\FilamentSpatieLaravelHealth;

use Filament\PluginServiceProvider;
use ShuvroRoy\FilamentSpatieLaravelHealth\Pages\HealthCheckResults;
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
        return [
            HealthCheckResults::class,
        ];
    }

    protected function getStyles(): array
    {
        return [
            self::$name . '-styles' => __DIR__ . '/../dist/app.css',
        ];
    }
}
