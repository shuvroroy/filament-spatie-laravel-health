@props(['status', 'count' => null])

@php($key = in_array($status, ['ok', 'failed', 'warning', 'crashed', 'skipped'], true) ? $status : 'other')
<span class="health-status-badge" data-severity="{{ $key }}">
    <span aria-hidden="true" class="health-status-dot"></span>
    {{ $count === null ? __('filament-spatie-health::health.status_labels.' . $key) : trans_choice('filament-spatie-health::health.status_counts.' . $key, $count) }}
</span>
