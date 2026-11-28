<?php

namespace ShuvroRoy\FilamentSpatieLaravelHealth;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FilamentSpatieLaravelHealthServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('filament-spatie-health')
            ->hasTranslations()
            ->hasViews();
    }
}
