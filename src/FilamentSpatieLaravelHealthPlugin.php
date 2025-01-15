<?php

namespace ShuvroRoy\FilamentSpatieLaravelHealth;

use Filament\Contracts\Plugin;
use Filament\Panel;
use Filament\Support\Concerns\EvaluatesClosures;
use ShuvroRoy\FilamentSpatieLaravelHealth\Pages\HealthCheckResults;

class FilamentSpatieLaravelHealthPlugin implements Plugin
{
    use EvaluatesClosures;

    protected bool | \Closure $authorizeUsing = true;

    protected bool $navigationGroupSet = false;

    protected string $page = HealthCheckResults::class;

    protected string | \Closure | null $navigationGroup = null;

    protected int | \Closure $navigationSort = 1;

    protected string | \Closure $navigationIcon = 'heroicon-o-heart';

    protected string | \Closure | null $navigationLabel = null;

    public function register(Panel $panel): void
    {
        // @phpstan-ignore-next-line
        $panel->pages([$this->getPage()]);
    }

    public function boot(Panel $panel): void
    {
        //
    }

    public function authorize(bool | \Closure $callback = true): static
    {
        $this->authorizeUsing = $callback;

        return $this;
    }

    public function isAuthorized(): bool
    {
        return $this->evaluate($this->authorizeUsing) === true;
    }

    public static function get(): static
    {
        /** @var static $instance */
        $instance = filament(app(static::class)->getId());

        return $instance;
    }

    public function getId(): string
    {
        return 'filament-spatie-health';
    }

    public static function make(): static
    {
        return new static;
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

    public function navigationGroup(string | \Closure | null $navigationGroup): static
    {
        $this->navigationGroup = $navigationGroup;
        $this->navigationGroupSet = true;

        return $this;
    }

    public function getNavigationGroup(): ?string
    {
        $navigationGroup = $this->evaluate($this->navigationGroup);

        if ($navigationGroup === null && $this->navigationGroupSet === false) {
            return __('filament-spatie-health::health.pages.health_check_results.navigation.group');
        }

        return $navigationGroup;
    }

    public function navigationSort(int | \Closure $navigationSort): static
    {
        $this->navigationSort = $navigationSort;

        return $this;
    }

    public function getNavigationSort(): int
    {
        return $this->evaluate($this->navigationSort);
    }

    public function navigationIcon(string | \Closure $navigationIcon): static
    {
        $this->navigationIcon = $navigationIcon;

        return $this;
    }

    public function getNavigationIcon(): string
    {
        return $this->evaluate($this->navigationIcon);
    }

    public function navigationLabel(string | \Closure | null $navigationLabel): static
    {
        $this->navigationLabel = $navigationLabel;

        return $this;
    }

    public function getNavigationLabel(): string
    {
        return $this->evaluate($this->navigationLabel) ?? __('filament-spatie-health::health.pages.health_check_results.navigation.label');
    }
}
