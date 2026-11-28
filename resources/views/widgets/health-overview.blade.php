<x-filament-widgets::widget
    class="filament-spatie-health-overview"
    wire:poll.visible.60s
    x-data="{}"
    :x-load-css="\Illuminate\Support\Js::from([\Filament\Support\Facades\FilamentAsset::getStyleHref('filament-spatie-health-styles', package: 'filament-spatie-health')])->toHtml()"
>
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
            <dl class="health-status-groups">
                @foreach ($checksByStatus as $status => $checks)
                    <div class="health-status-group" data-severity="{{ $status }}">
                        <dt>
                            <x-filament-spatie-health::status-badge :status="$status" :count="$checks->count()" />
                        </dt>
                        <dd>
                            <ul class="health-check-list">
                                @foreach ($checks->take(2) as $check)
                                    <li>
                                        <x-filament-spatie-health::check-icon :name="$check->name" class="health-row-icon" />
                                        <div>
                                            <strong>{{ $check->label ?: $check->name }}</strong>
                                            @if (filled($message = $check->notificationMessage ?: $check->shortSummary))
                                                <p>{{ \Illuminate\Support\Str::limit($message, 160) }}</p>
                                            @endif
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </dd>
                    </div>
                @endforeach
            </dl>
        @else
            <p class="health-empty-state">
                <x-filament::icon :icon="$totalCount ? 'heroicon-o-check-circle' : 'heroicon-o-clock'" aria-hidden="true" />
                {{ __($totalCount ? 'filament-spatie-health::health.none_need_attention' : 'filament-spatie-health::health.no_results') }}
            </p>
        @endif

    </section>
</x-filament-widgets::widget>
