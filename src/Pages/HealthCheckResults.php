<?php

namespace ShuvroRoy\FilamentSpatieLaravelHealth\Pages;

use Carbon\Carbon;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;
use Livewire\Attributes\Renderless;
use Livewire\Attributes\Url;
use ShuvroRoy\FilamentSpatieLaravelHealth\FilamentSpatieLaravelHealthPlugin;
use ShuvroRoy\FilamentSpatieLaravelHealth\Pages\Concerns\HasSelectedHealthRun;
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
    use HasSelectedHealthRun;

    // Check names are identifiers, even when the column's collation folds case or accents.
    private const EXACT_NAME_PREDICATES = [
        'mysql' => 'check_name = CAST(? AS BINARY)',
        'mariadb' => 'check_name = CAST(? AS BINARY)',
        'sqlite' => 'check_name = ? COLLATE BINARY',
        'pgsql' => 'CAST(check_name AS text) COLLATE "C" = ?',
        'sqlsrv' => 'CONVERT(varbinary(max), CONVERT(nvarchar(max), check_name)) = CONVERT(varbinary(max), CONVERT(nvarchar(max), ?))',
    ];

    /**
     * @var array<string, string>
     */
    protected $listeners = ['refresh-component' => '$refresh'];

    protected string $view = 'filament-spatie-health::pages.health-check-results';

    #[Url]
    public bool $needsAttention = false;

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
                ->label(__('filament-spatie-health::health.pages.health_check_results.buttons.run_checks'))
                ->authorize(fn (): bool => $this->canRunChecks())
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
        /** @var ResultStore $store The active binding follows the application's health.result_stores configuration. */
        $store = app(ResultStore::class);
        $checkResults = $this->run === null ? $store->latestResults() : $this->savedRun($store, $this->run);
        $attentionResults = ChecksNeedingAttention::from($checkResults);

        return [
            'healthPlugin' => FilamentSpatieLaravelHealthPlugin::get(),
            'lastRanAt' => $checkResults ? Carbon::instance($checkResults->finishedAt) : null,
            'checkResults' => $checkResults,
            'visibleResults' => $this->needsAttention ? $attentionResults : $checkResults?->storedCheckResults,
            'hasCheckHistory' => $store instanceof EloquentHealthResultStore,
            'attentionCount' => $attentionResults->count(),
        ];
    }

    #[Renderless]
    public function checkHistory(string $name, ResultStore $store): string
    {
        abort_unless(static::canAccess() && FilamentSpatieLaravelHealthPlugin::get()->isAuthorized(), 403);

        if (! $store instanceof EloquentHealthResultStore) {
            return '';
        }

        /** @var class-string<HealthCheckResultHistoryItem> $model */
        $model = $store::determineHistoryItemModel();

        $query = $model::query();
        $historyItem = $query->getModel();
        $driver = $historyItem->getConnection()->getDriverName();
        $exactName = self::EXACT_NAME_PREDICATES[$driver] ?? 'check_name = ?';

        $outcomes = $query->whereRaw($exactName, [$name])
            ->latest('created_at')
            ->orderByDesc($historyItem->getIncrementing() ? $historyItem->getKeyName() : 'batch')
            ->limit(10)
            ->get(['created_at', 'status']);

        return view('filament-spatie-health::pages.check-history', [
            'outcomes' => $outcomes,
        ])->render();
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

        abort_unless($this->canRunChecks(), 403);

        Artisan::call(RunHealthChecksCommand::class);

        $this->dispatch('refresh-component');

        Notification::make()
            ->title(__('filament-spatie-health::health.pages.health_check_results.notifications.results_refreshed'))
            ->success()
            ->send();
    }

    private function canRunChecks(): bool
    {
        return static::canAccess() && FilamentSpatieLaravelHealthPlugin::get()->isAuthorizedToRunChecks();
    }

    public static function canAccess(): bool
    {
        return FilamentSpatieLaravelHealthPlugin::get()->isAuthorized();
    }
}
