<?php

namespace ShuvroRoy\FilamentSpatieLaravelHealth;

use Filament\Contracts\Plugin;
use Filament\Panel;
use ShuvroRoy\FilamentSpatieLaravelHealth\Pages\HealthCheckResults;

class FilamentSpatieLaravelHealthPlugin implements Plugin
{
    protected string $page = HealthCheckResults::class;

    public function register(Panel $panel): void
    {
        // @phpstan-ignore-next-line
        $panel->pages([$this->getPage()]);
    }

    public function boot(Panel $panel): void
    {
        //
    }

    public function getId(): string
    {
        return 'filament-spatie-health';
    }

    public static function make(): static
    {
        return new static();
    }

    public function usingPage(string $page): static
    {
        $this->page = $page;

        return $this;
    }

    public function getPage(): string
    {
        return $this->page;
    }
}
