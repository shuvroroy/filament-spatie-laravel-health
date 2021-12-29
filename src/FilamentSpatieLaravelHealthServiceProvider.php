<?php

namespace ShuvroRoy\FilamentSpatieLaravelHealth;

use Filament\PluginServiceProvider;
use ShuvroRoy\FilamentSpatieLaravelHealth\Pages\HealthCheckResults;

class FilamentSpatieLaravelHealthServiceProvider extends PluginServiceProvider
{
    public static string $name = 'filament-spatie-health';

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
