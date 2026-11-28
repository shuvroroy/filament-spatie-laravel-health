<x-filament-panels::page>
    <div class="filament-spatie-health">
        @if ($run !== null && $checkResults === null)
            <p class="health-results-empty">
                <x-filament::icon icon="heroicon-o-clock" aria-hidden="true" />
                {{ __('filament-spatie-health::health.run_unavailable') }}
            </p>
        @else
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
                    <div class="health-run-time" @if ($run === null && $lastRanAt->diffInMinutes() > 5) data-stale @endif>
                        <x-filament::icon icon="heroicon-o-clock" aria-hidden="true" />
                        <span>{{ __($run === null ? 'filament-spatie-health::health.latest_run' : 'filament-spatie-health::health.saved_run') }} · <time datetime="{{ $lastRanAt->toIso8601String() }}" title="{{ $lastRanAt->isoFormat('LLLL') }}">{{ $run === null ? $lastRanAt->diffForHumans() : $lastRanAt->isoFormat('LLL') }}</time></span>
                    </div>
                @endif
            </div>

            @if ($visibleResults?->isNotEmpty())
                <ul class="health-result-grid">
                    @foreach ($visibleResults as $result)
                        @include('filament-spatie-health::pages.check-result-card')
                    @endforeach
                </ul>
            @else
                <p class="health-results-empty">
                    <x-filament::icon :icon="$checkResults?->storedCheckResults->isNotEmpty() ? 'heroicon-o-check-circle' : 'heroicon-o-clock'" aria-hidden="true" />
                    {{ __($checkResults?->storedCheckResults->isNotEmpty() ? 'filament-spatie-health::health.none_need_attention' : 'filament-spatie-health::health.no_results') }}
                </p>
            @endif
        @endif
    </div>
</x-filament-panels::page>
