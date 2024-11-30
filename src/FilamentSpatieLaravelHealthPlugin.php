<?php

namespace ShuvroRoy\FilamentSpatieLaravelHealth;

use Filament\Contracts\Plugin;
use Filament\Panel;
use ShuvroRoy\FilamentSpatieLaravelHealth\Pages\HealthCheckResults;
use Filament\Support\Concerns\EvaluatesClosures;

class FilamentSpatieLaravelHealthPlugin implements Plugin
{
    use EvaluatesClosures;

    protected bool|\Closure $authorizeUsing = true;

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

    public function authorize(bool|\Closure $callback = true): static
    {
        $this->authorizeUsing = $callback;

        return $this;
    }

    public function isAuthorized(): bool
    {
        return true === $this->evaluate($this->authorizeUsing);
    }

    public static function get(): static
    {
        return filament(app(static::class)->getId());
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
