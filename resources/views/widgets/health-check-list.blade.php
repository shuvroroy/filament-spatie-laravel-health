<ul class="health-check-list">
    @foreach ($checks as $check)
        <li>
            <x-filament-spatie-health::check-icon :name="$check->name" class="health-row-icon" />
            <div>
                <strong>{{ $check->label ?: $check->name }}</strong>
                @if (filled($message = $check->notificationMessage ?: $check->shortSummary))
                    <p>{{ \Illuminate\Support\Str::limit($message, 160) }}</p>
                @endif
            </div>
            @if ($checks->count() === 1)
                <x-filament-spatie-health::status-badge :status="$status" :count="1" />
            @endif
        </li>
    @endforeach
</ul>
