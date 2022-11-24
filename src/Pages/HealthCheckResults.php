<?php

namespace ShuvroRoy\FilamentSpatieLaravelHealth\Pages;

use Carbon\Carbon;
use Filament\Pages\Actions\ButtonAction;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Artisan;
use Spatie\Health\Commands\RunHealthChecksCommand;
use Spatie\Health\ResultStores\ResultStore;
use Spatie\Health\ResultStores\StoredCheckResults\StoredCheckResult;

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

    protected function getViewData(): array
    {

        $lastsResults = app(ResultStore::class)
            ->latestResults();

        $storedCheckResults = $lastsResults?->storedCheckResults
            ->map(function (StoredCheckResult $result) {
                $result->backgroundColor = $this->getBackgroundColor($result->status);
                $result->iconColor = $this->getIconColor($result->status);
                $result->icon = $this->getIcon($result->status);

                return $result;
            });

        return [
            'lastRanAt' => new Carbon($lastsResults?->finishedAt),
            'storedCheckResults' => $storedCheckResults,
        ];
    }

    public function refresh(): void
    {
        Artisan::call(RunHealthChecksCommand::class);

        $this->emitSelf('refreshComponent');
    }

    protected function getBackgroundColor(string $status): string
    {
        $colors = config('filament-spatie-laravel-health.background-colors');
        return $colors[$status] ?? $colors['default'] ?? '';
    }

    protected function getIconColor(string $status): string
    {
        $colors = config('filament-spatie-laravel-health.icon-colors');
        return $colors[$status] ?? $colors['default'] ?? '';
    }

    protected function getIcon(string $status): string
    {
        $icons = config('filament-spatie-laravel-health.icons');
        return $icons[$status] ?? $icons['default'] ?? '';
    }
}
