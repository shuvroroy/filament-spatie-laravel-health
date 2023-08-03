<?php

namespace ShuvroRoy\FilamentSpatieLaravelHealth;

use Filament\Contracts\Plugin;
use Filament\Panel;

class FilamentSpatieLaravelHealthPlugin implements Plugin
{
    protected bool $hasHealthPage = false;

    public function getId(): string
    {
        return 'filament-spatie-health';
    }

    public function register(Panel $panel): void
    {
        // @phpstan-ignore-next-line
        $panel->pages([
            config('filament-spatie-laravel-health.pages.health'),
        ]);
    }

    public function boot(Panel $panel): void
    {
        //
    }

    public function healthPage(bool $condition = true): static
    {
        $this->hasHealthPage = $condition;

        return $this;
    }

    public function hasHealthPage(): bool
    {
        return $this->hasHealthPage;
    }

    public static function make(): static
    {
        return app(static::class);
    }
}
