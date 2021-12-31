<?php

namespace ShuvroRoy\FilamentSpatieLaravelHealth\Pages;

use Carbon\Carbon;
use Filament\Pages\Actions\ButtonAction;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Artisan;
use Spatie\Health\Commands\RunHealthChecksCommand;
use Spatie\Health\ResultStores\EloquentHealthResultStore;

class HealthCheckResults extends Page
{
    protected $listeners = ['refreshComponent' => '$refresh'];

    protected static ?string $navigationGroup = 'Settings';

    protected static ?string $navigationLabel = 'Application Health';

    protected static ?string $navigationIcon = 'heroicon-o-heart';

    protected static ?string $title = 'Application Health';

    protected static string $view = 'filament-spatie-health::pages.health-check-results';

    protected function getActions(): array
    {
        return [
            ButtonAction::make('Refresh')->action('refresh'),
        ];
    }

    protected function getHeading(): string
    {
        return config('filament-spatie-laravel-health.resource.heading') ?? parent::getTitle();
    }

    protected static function getNavigationGroup(): ?string
    {
        return config('filament-spatie-laravel-health.resource.navigation.group') ?? parent::getNavigationGroup();
    }

    protected static function getNavigationLabel(): string
    {
        return config('filament-spatie-laravel-health.resource.navigation.label') ?? parent::getNavigationLabel();
    }

    protected static function getNavigationSort(): ?int
    {
        return config('filament-spatie-laravel-health.resource.navigation.sort') ?? parent::getNavigationSort();
    }

    protected function getViewData(): array
    {
        $checkResults = (new EloquentHealthResultStore())->latestResults();

        return [
            'lastRanAt' => new Carbon($checkResults?->finishedAt),
            'checkResults' => $checkResults,
        ];
    }

    public function refresh(): void
    {
        Artisan::call(RunHealthChecksCommand::class);

        $this->emitSelf('refreshComponent');
    }
}
