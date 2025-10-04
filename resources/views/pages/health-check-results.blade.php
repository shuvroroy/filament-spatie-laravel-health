@php
    if (!function_exists('iconColor')) {
        function iconColor($status)
        {
            return match ($status) {
                Spatie\Health\Enums\Status::ok()->value => 'success',
                Spatie\Health\Enums\Status::warning()->value => 'warning',
                Spatie\Health\Enums\Status::skipped()->value => 'info',
                Spatie\Health\Enums\Status::failed()->value, Spatie\Health\Enums\Status::crashed()->value => 'danger',
                default => 'info',
            };
        }
    }

    if (!function_exists('icon')) {
        function icon($status)
        {
            return match ($status) {
                Spatie\Health\Enums\Status::ok()->value => 'check-circle',
                Spatie\Health\Enums\Status::warning()->value => 'exclamation-circle',
                Spatie\Health\Enums\Status::skipped()->value => 'arrow-circle-right',
                Spatie\Health\Enums\Status::failed()->value, Spatie\Health\Enums\Status::crashed()->value => 'x-circle',
                default => '',
            };
        }
    }
@endphp

<x-filament-panels::page>
    <div x-data="{}" x-load-css="[@js(\Filament\Support\Facades\FilamentAsset::getStyleHref('filament-spatie-health-styles', package: 'filament-spatie-health'))]">
        <div class="filament-spatie-health">
            @if (count($checkResults?->storedCheckResults ?? []))
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 mb-5">
                    @foreach ($checkResults->storedCheckResults as $result)
                        <x-filament::section :has-content-el="false" :icon="'heroicon-s-' . icon($result->status)" :icon-color="match ($result->status) {
                            Spatie\Health\Enums\Status::ok()->value => 'success',
                            Spatie\Health\Enums\Status::warning()->value => 'warning',
                            Spatie\Health\Enums\Status::skipped()->value => 'info',
                            Spatie\Health\Enums\Status::failed()->value,
                            Spatie\Health\Enums\Status::crashed()->value
                                => 'danger',
                            default => 'gray',
                        }" icon-size="2xl">
                            <x-slot name="heading">
                                {{ $result->label }}
                            </x-slot>

                            <x-slot name="description">
                                @if (!empty($result->notificationMessage))
                                    {{ $result->notificationMessage }}
                                @else
                                    {{ $result->shortSummary }}
                                @endif
                            </x-slot>
                        </x-filament::section>
                    @endforeach
                </div>
            @endif

            @if ($lastRanAt)
                <div
                    class="{{ $lastRanAt->diffInMinutes() > 5 ? 'text-danger-400' : 'text-info-400' }} text-md text-center font-medium">
                    <span>{{ __('filament-spatie-health::health.pages.health_check_results.notifications.check_results', ['lastRanAt' => $lastRanAt->diffForHumans()]) }}</span>
                </div>
            @endif
        </div>
    </div>
</x-filament-panels::page>
