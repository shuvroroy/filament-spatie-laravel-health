<?php

namespace ShuvroRoy\FilamentSpatieLaravelHealth\Pages;

use Carbon\Carbon;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;
use Livewire\Attributes\Url;
use ShuvroRoy\FilamentSpatieLaravelHealth\FilamentSpatieLaravelHealthPlugin;
use ShuvroRoy\FilamentSpatieLaravelHealth\Support\ChecksNeedingAttention;
use Spatie\Health\Commands\RunHealthChecksCommand;
use Spatie\Health\Models\HealthCheckResultHistoryItem;
use Spatie\Health\ResultStores\EloquentHealthResultStore;
use Spatie\Health\ResultStores\ResultStore;
use Spatie\Health\ResultStores\StoredCheckResults\StoredCheckResult;
use Spatie\Health\ResultStores\StoredCheckResults\StoredCheckResults;
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

    #[Url]
    public ?string $run = null;

    protected function getHeaderActions(): array
    {
        if ($this->run !== null) {
            return [
                Action::make('backToLatest')
                    ->label(__('filament-spatie-health::health.back_to_latest'))
                    ->url(static::getUrl()),
            ];
        }

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
        $store = app(ResultStore::class);
        $checkResults = $this->run === null ? $store->latestResults() : $this->savedRun($store, $this->run);
        $attentionResults = ChecksNeedingAttention::from($checkResults);

        return [
            'lastRanAt' => $checkResults ? Carbon::instance($checkResults->finishedAt) : null,
            'checkResults' => $checkResults,
            'visibleResults' => $this->needsAttention ? $attentionResults : $checkResults?->storedCheckResults,
            'attentionCount' => $attentionResults->count(),
        ];
    }

    private function savedRun(ResultStore $store, string $batch): ?StoredCheckResults
    {
        abort_unless(static::canAccess() && FilamentSpatieLaravelHealthPlugin::get()->isAuthorized(), 403);

        if (! $store instanceof EloquentHealthResultStore || ! Str::isUuid($batch)) {
            return null;
        }

        /** @var class-string<HealthCheckResultHistoryItem> $model */
        $model = $store::determineHistoryItemModel();
        $items = $model::query()->where('batch', $batch)->latest('created_at')->get();
        $latest = $items->first();

        if ($latest === null) {
            return null;
        }

        $checks = $items->map(fn (HealthCheckResultHistoryItem $item) => new StoredCheckResult(
            name: $item->check_name,
            label: $item->check_label,
            notificationMessage: $item->notification_message,
            shortSummary: $item->short_summary ?? '',
            status: $item->status,
            meta: $item->meta,
        ));

        return new StoredCheckResults($latest->created_at, $checks);
    }

    public function refresh(): void
    {
        if ($this->run !== null) {
            return;
        }

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
