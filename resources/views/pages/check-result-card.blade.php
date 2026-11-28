@php
    $label = $result->label ?: $result->name;
    $message = filled($result->notificationMessage) ? $result->notificationMessage : $result->shortSummary;
    $preview = \Illuminate\Support\Str::limit($message, 160);
    $summary = $result->shortSummary;
    $hasAdditionalSummary = filled($summary) && $summary !== $message && strcasecmp($summary, $result->status) !== 0;
    $metadata = $healthPlugin->getCheckMetadata($result);
@endphp

<li class="health-result-card" data-severity="{{ $result->status }}" wire:key="health-check-{{ $result->name }}">
    <div class="health-result-heading">
        <x-filament-spatie-health::check-icon :name="$result->name" class="health-result-icon" />
        <x-filament-spatie-health::status-badge :status="$result->status" />
    </div>
    <h2>{{ $label }}</h2>
    @if (filled($preview))
        <p>{{ $preview }}</p>
    @endif

    @if ($hasCheckHistory || $preview !== $message || $hasAdditionalSummary || $metadata !== [])
        @php($dialogId = $this->getId() . '-check-' . sha1($result->name))
        <div class="health-result-actions">
            <x-filament::link tag="button" type="button" size="sm" aria-haspopup="dialog"
                :aria-controls="$dialogId"
                :aria-label="__('filament-spatie-health::health.view_details') . ' · ' . $label"
                x-on:click="$dispatch('open-modal', { id: $el.getAttribute('aria-controls') })">
                {{ __('filament-spatie-health::health.view_details') }}
            </x-filament::link>
        </div>

        @teleport('body')
            <x-filament::modal
                :id="$dialogId"
                :aria-labelledby="$dialogId . '-title'"
                slide-over
                sticky-header
                width="md"
            >
                <x-slot name="header">
                    <div class="filament-spatie-health health-details-header">
                        <x-filament-spatie-health::check-icon :name="$result->name" class="health-result-icon" />
                        <div>
                            <h2 id="{{ $dialogId }}-title">{{ $label }}</h2>
                            <time datetime="{{ $lastRanAt->toIso8601String() }}" title="{{ $lastRanAt->isoFormat('LLLL') }}">
                                {{ $lastRanAt->isoFormat('lll') }}
                            </time>
                        </div>
                    </div>
                </x-slot>

                <div class="filament-spatie-health health-check-details">
                    <div class="health-details-result" data-severity="{{ $result->status }}">
                        <x-filament-spatie-health::status-badge :status="$result->status" />
                        @if ($hasAdditionalSummary)
                            <strong>{{ $summary }}</strong>
                        @endif
                        @if (filled($message))
                            <p>{{ $message }}</p>
                        @endif
                    </div>
                    @if ($metadata !== [])
                        <section>
                            <h3>{{ __('filament-spatie-health::health.recorded_values') }}</h3>
                            <dl>
                                @foreach ($metadata as $field)
                                    <div>
                                        <dt>{{ $field['label'] }}</dt>
                                        <dd>{{ is_bool($field['value']) ? json_encode($field['value']) : $field['value'] }}</dd>
                                    </div>
                                @endforeach
                            </dl>
                        </section>
                    @endif
                    @if ($hasCheckHistory)
                        <div x-data="{ history: null }" data-dialog="{{ $dialogId }}" data-check="{{ $result->name }}"
                            x-on:open-modal.window="if ($event.detail.id === $el.dataset.dialog) history = await $wire.checkHistory($el.dataset.check)">
                            <x-filament::loading-indicator x-show="history === null" />
                            <div x-html="history"></div>
                        </div>
                    @endif
                </div>
            </x-filament::modal>
        @endteleport
    @endif
</li>
