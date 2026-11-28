<x-filament-widgets::widget class="filament-spatie-health-overview" wire:poll.visible.60s>
    <section class="health-card">
        <header class="health-card-header">
            <span class="health-card-icon" aria-hidden="true">
                <x-filament::icon icon="heroicon-o-heart" />
            </span>
            <div>
                <h2>{{ __('filament-spatie-health::health.pages.health_check_results.heading') }}</h2>
                @if ($lastRanAt)
                    <time datetime="{{ $lastRanAt->toIso8601String() }}">
                        {{ __('filament-spatie-health::health.pages.health_check_results.notifications.check_results', ['lastRanAt' => $lastRanAt->diffForHumans()]) }}
                    </time>
                @endif
            </div>
            <x-filament::link :href="$allChecksUrl" color="gray" size="sm" class="health-all-link" icon="heroicon-m-arrow-right" icon-position="after">
                {{ __('filament-spatie-health::health.all_checks') }} ({{ $totalCount }})
            </x-filament::link>
        </header>
        @if ($totalCount)
            @include('filament-spatie-health::widgets.health-chart')
        @endif
        @if ($attentionCount)
            <div class="health-status-groups">
                @foreach ($checksByStatus as $status => $checks)
                    <div class="health-status-group" data-severity="{{ $status }}" wire:key="health-group-{{ $status }}">
                        @if ($checks->count() > 1)
                            <details class="health-group-disclosure" wire:ignore.self>
                                <summary>
                                    <strong class="health-group-heading">
                                        <x-filament::icon :icon="match ($status) {
                                            'failed' => 'heroicon-o-x-circle',
                                            'warning' => 'heroicon-o-exclamation-triangle',
                                            'crashed' => 'heroicon-o-bolt',
                                            'skipped' => 'heroicon-o-forward',
                                        }" aria-hidden="true" />
                                        {{ __('filament-spatie-health::health.status_groups.' . $status) }}
                                        <span class="health-group-count">{{ $checks->count() }}</span>
                                    </strong>
                                    <x-filament::icon icon="heroicon-m-chevron-down" class="health-group-chevron" aria-hidden="true" />
                                    <span class="health-group-preview">
                                        @foreach ($checks->take(3) as $check)
                                            <span class="health-group-check">
                                                <x-filament-spatie-health::check-icon :name="$check->name" />
                                                <span>{{ $check->label ?: $check->name }}</span>
                                            </span>
                                        @endforeach
                                        @if ($checks->count() > 3)
                                            <span>+{{ $checks->count() - 3 }}</span>
                                        @endif
                                    </span>
                                </summary>
                                @include('filament-spatie-health::widgets.health-check-list')
                            </details>
                        @else
                            @include('filament-spatie-health::widgets.health-check-list')
                        @endif
                    </div>
                @endforeach
            </div>
        @else
            <p class="health-empty-state">
                <x-filament::icon :icon="$totalCount ? 'heroicon-o-check-circle' : 'heroicon-o-clock'" aria-hidden="true" />
                {{ __($totalCount ? 'filament-spatie-health::health.none_need_attention' : 'filament-spatie-health::health.no_results') }}
            </p>
        @endif

    </section>
</x-filament-widgets::widget>
