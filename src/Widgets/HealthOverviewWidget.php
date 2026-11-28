<?php

namespace ShuvroRoy\FilamentSpatieLaravelHealth\Widgets;

use Carbon\Carbon;
use Filament\Widgets\Widget;
use Illuminate\Support\Collection;
use ShuvroRoy\FilamentSpatieLaravelHealth\FilamentSpatieLaravelHealthPlugin;
use ShuvroRoy\FilamentSpatieLaravelHealth\Support\ChecksNeedingAttention;
use Spatie\Health\Models\HealthCheckResultHistoryItem;
use Spatie\Health\ResultStores\EloquentHealthResultStore;
use Spatie\Health\ResultStores\ResultStore;

class HealthOverviewWidget extends Widget
{
    private const HISTORY_RUNS = 12;

    protected string $view = 'filament-spatie-health::widgets.health-overview';

    public static function canView(): bool
    {
        $plugin = FilamentSpatieLaravelHealthPlugin::get();

        return $plugin->isAuthorized() && $plugin->getPage()::canAccess();
    }

    protected function getViewData(): array
    {
        abort_unless(static::canView(), 403);

        $store = app(ResultStore::class);
        $results = $store->latestResults();
        $attention = ChecksNeedingAttention::from($results);
        $page = FilamentSpatieLaravelHealthPlugin::get()->getPage();

        return [
            'recentRuns' => $results ? $this->recentRuns($store) : collect(),
            'statusCounts' => $results?->storedCheckResults->countBy('status'),
            'checksByStatus' => $attention->groupBy('status'),
            'attentionCount' => $attention->count(),
            'totalCount' => $results?->storedCheckResults->count() ?? 0,
            'lastRanAt' => $results ? Carbon::instance($results->finishedAt) : null,
            'allChecksUrl' => $page::getUrl(),
            'attentionUrl' => $page::getUrl(['needsAttention' => 1]),
        ];
    }

    /** @return Collection<int, HealthCheckResultHistoryItem> */
    private function recentRuns(ResultStore $store): Collection
    {
        if (! $store instanceof EloquentHealthResultStore) {
            return new Collection;
        }

        /** @var class-string<HealthCheckResultHistoryItem> $model */
        $model = $store::determineHistoryItemModel();
        $statuses = ChecksNeedingAttention::statuses();
        $placeholders = implode(', ', array_fill(0, count($statuses), '?'));

        return $model::query()
            ->whereIn('batch', $this->recentBatchIds($model))
            ->select('batch')
            ->selectRaw('MAX(created_at) AS created_at, COUNT(*) AS total_count')
            ->selectRaw("SUM(CASE WHEN status IN ({$placeholders}) THEN 1 ELSE 0 END) AS attention_count", $statuses)
            ->groupBy('batch')
            ->orderBy('created_at')
            ->orderBy('batch')
            ->get();
    }

    /**
     * @param  class-string<HealthCheckResultHistoryItem>  $model
     * @return list<string>
     */
    private function recentBatchIds(string $model): array
    {
        $batches = [];
        $before = null;

        do {
            // Read complete groups of timestamps so runs tied at the cutoff are ranked together.
            $times = $model::query()
                ->when($before !== null, fn ($query) => $query->where('created_at', '<', $before))
                ->distinct()
                ->latest('created_at')
                ->limit(self::HISTORY_RUNS)
                ->toBase()
                ->pluck('created_at');

            $runs = $model::query()
                ->whereIn('created_at', $times)
                ->whereNotIn('batch', $batches)
                ->groupBy('batch')
                ->orderByRaw('MAX(created_at) DESC')
                ->orderByDesc('batch')
                ->limit(self::HISTORY_RUNS - count($batches))
                ->get(['batch']);

            foreach ($runs as $run) {
                $batches[] = $run->batch;
            }
            $before = $times->last();
        } while ($times->count() === self::HISTORY_RUNS && count($batches) < self::HISTORY_RUNS);

        return $batches;
    }
}
