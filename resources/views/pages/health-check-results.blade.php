<x-filament-panels::page>
    <div class="filament-spatie-health">
        <div class="health-results-toolbar">
            <div class="health-filter-tabs" role="group" aria-label="{{ __('filament-spatie-health::health.pages.health_check_results.heading') }}">
                <button type="button" aria-pressed="{{ $needsAttention ? 'false' : 'true' }}" wire:click="$set('needsAttention', false)">
                    {{ __('filament-spatie-health::health.all_checks') }}
                    <span>{{ $checkResults?->storedCheckResults->count() ?? 0 }}</span>
                </button>
                <button type="button" aria-pressed="{{ $needsAttention ? 'true' : 'false' }}" wire:click="$set('needsAttention', true)">
                    {{ __('filament-spatie-health::health.needs_attention') }}
                    <span>{{ $attentionCount }}</span>
                </button>
            </div>

            @if ($lastRanAt)
                <div class="health-run-time" @if ($lastRanAt->diffInMinutes() > 5) data-stale @endif>
                    <x-filament::icon icon="heroicon-o-clock" aria-hidden="true" />
                    <span>{{ __('filament-spatie-health::health.latest_run') }} · <time datetime="{{ $lastRanAt->toIso8601String() }}" title="{{ $lastRanAt->isoFormat('LLLL') }}">{{ $lastRanAt->diffForHumans() }}</time></span>
                </div>
            @endif
        </div>

        @if ($visibleResults?->isNotEmpty())
            <ul class="health-result-grid">
                @foreach ($visibleResults as $result)
                    <li class="health-result-card" data-severity="{{ $result->status }}" wire:key="health-check-{{ $result->name }}">
                        <div class="health-result-heading">
                            <x-filament-spatie-health::check-icon :name="$result->name" class="health-result-icon" />
                            <x-filament-spatie-health::status-badge :status="$result->status" />
                        </div>
                        <h2>{{ $result->label ?: $result->name }}</h2>
                        @if (filled($message = $result->notificationMessage ?: $result->shortSummary))
                            <p>{{ $message }}</p>
                        @endif
                    </li>
                @endforeach
            </ul>
        @else
            <p class="health-results-empty">
                <x-filament::icon :icon="$checkResults?->storedCheckResults->isNotEmpty() ? 'heroicon-o-check-circle' : 'heroicon-o-clock'" aria-hidden="true" />
                {{ __($checkResults?->storedCheckResults->isNotEmpty() ? 'filament-spatie-health::health.none_need_attention' : 'filament-spatie-health::health.no_results') }}
            </p>
        @endif
    </div>
</x-filament-panels::page>
