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

    protected static ?string $navigationIcon = 'heroicon-o-heart';

    protected static string $view = 'filament-spatie-health::pages.health-check-results';

    protected function getActions(): array
    {
        return [
            ButtonAction::make(__('filament-spatie-health::health.pages.health_check_results.buttons.refresh'))->action('refresh'),
        ];
    }

    protected function getHeading(): string
    {
        return __('filament-spatie-health::health.pages.health_check_results.heading');
    }

    protected static function getNavigationGroup(): ?string
    {
        return __('filament-spatie-health::health.pages.health_check_results.navigation.group');
    }

    protected static function getNavigationLabel(): string
    {
        return __('filament-spatie-health::health.pages.health_check_results.navigation.label');
    }

    protected static function getNavigationSort(): ?int
    {
        return config('filament-spatie-laravel-health.page.navigation.sort') ?? parent::getNavigationSort();
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
