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
            ->select('batch')
            ->selectRaw('MAX(created_at) AS created_at, COUNT(*) AS total_count')
            ->selectRaw("SUM(CASE WHEN status IN ({$placeholders}) THEN 1 ELSE 0 END) AS attention_count", $statuses)
            ->groupBy('batch')
            ->orderByDesc('created_at')
            ->orderByRaw('MAX(id) DESC')
            ->limit(12)
            ->get()
            ->reverse()
            ->values();
    }
}
