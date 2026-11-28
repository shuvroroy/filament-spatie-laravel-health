<?php

namespace ShuvroRoy\FilamentSpatieLaravelHealth\Pages;

use Carbon\Carbon;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\Artisan;
use Livewire\Attributes\Url;
use ShuvroRoy\FilamentSpatieLaravelHealth\FilamentSpatieLaravelHealthPlugin;
use ShuvroRoy\FilamentSpatieLaravelHealth\Support\ChecksNeedingAttention;
use Spatie\Health\Commands\RunHealthChecksCommand;
use Spatie\Health\ResultStores\ResultStore;
use UnitEnum;

class HealthCheckResults extends Page
{
    /**
     * @var array<string, string>
     */
    protected $listeners = ['refresh-component' => '$refresh'];

    protected string $view = 'filament-spatie-health::pages.health-check-results';

    #[Url]
    public bool $needsAttention = false;

    protected function getHeaderActions(): array
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

    public static function getNavigationGroup(): string | UnitEnum | null
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

    public function getTitle(): string | Htmlable
    {
        return FilamentSpatieLaravelHealthPlugin::get()->getNavigationLabel();
    }

    protected function getViewData(): array
    {
        $checkResults = app(ResultStore::class)->latestResults();
        $attentionResults = ChecksNeedingAttention::from($checkResults);

        return [
            'lastRanAt' => $checkResults ? Carbon::instance($checkResults->finishedAt) : null,
            'checkResults' => $checkResults,
            'visibleResults' => $this->needsAttention ? $attentionResults : $checkResults?->storedCheckResults,
            'attentionCount' => $attentionResults->count(),
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
