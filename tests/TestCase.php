<?php

namespace ShuvroRoy\FilamentSpatieLaravelHealth\Tests;

use Filament\FilamentServiceProvider;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Livewire\LivewireServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;
use ShuvroRoy\FilamentSpatieLaravelHealth\FilamentSpatieLaravelHealthServiceProvider;
use Spatie\Health\HealthServiceProvider;
use Spatie\Health\ResultStores\InMemoryHealthResultStore;

class TestCase extends Orchestra
{
    use LazilyRefreshDatabase;

    /** @return array<class-string> */
    protected function getPackageProviders($app): array
    {
        return [
            FilamentSpatieLaravelHealthServiceProvider::class,
            FilamentServiceProvider::class,
            HealthServiceProvider::class,
            LivewireServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app): void
    {
        config()->set('database.default', 'testing');
        config()->set('health.result_stores', [InMemoryHealthResultStore::class]);
        config()->set('health.notifications.enabled', false);
    }
}
