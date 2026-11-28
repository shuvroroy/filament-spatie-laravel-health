<figure class="health-chart">
    <figcaption class="health-chart-metric">
        @if ($attentionCount)
            <x-filament::link :href="$attentionUrl" size="sm" weight="semibold" class="health-attention-link" icon="heroicon-m-arrow-right" icon-position="after"
                :aria-label="__('filament-spatie-health::health.needs_attention') . ' (' . $attentionCount . ')'">
                {{ __('filament-spatie-health::health.needs_attention') }}
            </x-filament::link>
        @else
            <strong>{{ __('filament-spatie-health::health.needs_attention') }}</strong>
        @endif
        <span class="health-ratio"><b>{{ $attentionCount }}</b><span> / {{ $totalCount }}</span></span>
    </figcaption>
    <div class="health-plot">
        <span class="health-chart-period">
            {{ $recentRuns->count() > 1
                ? __('filament-spatie-health::health.recent_runs', ['count' => $recentRuns->count()])
                : __('filament-spatie-health::health.latest_run') }}
        </span>
        @if ($recentRuns->count() > 1)
            @php($peak = max(1, $recentRuns->max('attention_count')))
            <ol class="health-run-bars">
                @foreach ($recentRuns as $run)
                    @php($description = $run->created_at->isoFormat('LLL') . ' · ' . __('filament-spatie-health::health.needs_attention') . ' ' . $run->attention_count . '/' . $run->total_count)
                    <li wire:key="health-run-{{ $run->batch }}">
                        <a href="{{ $resultsPage::getUrl(['run' => $run->batch, 'needsAttention' => 1]) }}" aria-label="{{ $description }}"
                            x-tooltip="{ content: @js($description), trigger: 'mouseenter focus', allowHTML: false, theme: $store.theme }">
                            <span class="health-bar-count" aria-hidden="true">{{ $run->attention_count }}</span>
                            <span class="health-run-bar" aria-hidden="true" style="--height: {{ 100 * $run->attention_count / $peak }}%"></span>
                        </a>
                    </li>
                @endforeach
            </ol>
            <div class="health-chart-range" aria-hidden="true">
                <span>{{ $recentRuns->first()->created_at->isoFormat('MMM D, HH:mm') }}</span>
                <span>{{ $recentRuns->last()->created_at->isoFormat('MMM D, HH:mm') }}</span>
            </div>
        @else
            <div class="health-distribution" aria-hidden="true">
                @foreach ($statusCounts as $status => $count)
                    <span data-severity="{{ $status }}" style="flex-grow: {{ $count }}"></span>
                @endforeach
            </div>
            <ul class="health-chart-legend">
                @foreach ($statusCounts as $status => $count)
                    <li><i data-severity="{{ $status }}" aria-hidden="true"></i>
                        {{ trans_choice('filament-spatie-health::health.status_counts.' . (in_array($status, ['ok', 'warning', 'failed', 'crashed', 'skipped'], true) ? $status : 'other'), $count) }}
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</figure>
