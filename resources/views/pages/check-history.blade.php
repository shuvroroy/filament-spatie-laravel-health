@if ($outcomes->isNotEmpty())
    <section>
        <h3>{{ __('filament-spatie-health::health.check_history') }}</h3>
        <ol class="health-check-history">
            @foreach ($outcomes as $outcome)
                <li>
                    <a href="{{ $page::getUrl(['run' => $outcome->batch]) }}">
                        <time datetime="{{ $outcome->created_at->toIso8601String() }}">{{ $outcome->created_at->isoFormat('lll') }}</time>
                        <x-filament-spatie-health::status-badge :status="$outcome->status" />
                    </a>
                </li>
            @endforeach
        </ol>
    </section>
@endif
