<?php

namespace ShuvroRoy\FilamentSpatieLaravelHealth\Pages;

use Carbon\Carbon;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\Artisan;
use ShuvroRoy\FilamentSpatieLaravelHealth\FilamentSpatieLaravelHealthPlugin;
use Spatie\Health\Commands\RunHealthChecksCommand;
use Spatie\Health\ResultStores\ResultStore;

class HealthCheckResults extends Page
{
    /**
     * @var array<string, string>
     */
    protected $listeners = ['refresh-component' => '$refresh'];

    protected static string $view = 'filament-spatie-health::pages.health-check-results';

    protected function getActions(): array
    {
        return [
            Action::make(__('filament-spatie-health::health.pages.health_check_results.buttons.refresh'))
                ->button()
                ->action('refresh'),
        ];
    }

    public function getHeading(): string | Htmlable
    {
        return __('filament-spatie-health::health.pages.health_check_results.heading');
    }

    public static function getNavigationGroup(): ?string
    {
        return FilamentSpatieLaravelHealthPlugin::get()->getNavigationGroup();
    }

    public static function getNavigationLabel(): string
    {
        return FilamentSpatieLaravelHealthPlugin::get()->getNavigationLabel();
    }

    public static function getNavigationSort(): ?int
    {
        return FilamentSpatieLaravelHealthPlugin::get()->getNavigationSort();
    }

    public static function getNavigationIcon(): string
    {
        return FilamentSpatieLaravelHealthPlugin::get()->getNavigationIcon();
    }

    protected function getViewData(): array
    {
        $checkResults = app(ResultStore::class)->latestResults();

        return [
            'lastRanAt' => new Carbon($checkResults?->finishedAt),
            'checkResults' => $checkResults,
        ];
    }

    public function refresh(): void
    {
        Artisan::call(RunHealthChecksCommand::class);

        $this->dispatch('refresh-component');

        Notification::make()
            ->title(__('filament-spatie-health::health.pages.health_check_results.notifications.results_refreshed'))
            ->success()
            ->send();
    }

    public static function canAccess(): bool
    {
        return FilamentSpatieLaravelHealthPlugin::get()->isAuthorized();
    }
}
