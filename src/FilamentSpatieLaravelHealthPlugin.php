<?php

namespace ShuvroRoy\FilamentSpatieLaravelHealth;

use Closure;
use Filament\Contracts\Plugin;
use Filament\Pages\Page;
use Filament\Panel;
use Filament\Support\Concerns\EvaluatesClosures;
use LogicException;
use ShuvroRoy\FilamentSpatieLaravelHealth\Pages\HealthCheckResults;
use UnitEnum;

/** @phpstan-consistent-constructor */
class FilamentSpatieLaravelHealthPlugin implements Plugin
{
    use EvaluatesClosures;

    protected bool | Closure $authorizeUsing = true;

    protected bool $navigationGroupSet = false;

    /** @var class-string<Page> */
    protected string $page = HealthCheckResults::class;

    protected string | UnitEnum | Closure | null $navigationGroup = null;

    protected int | Closure $navigationSort = 1;

    protected string | Closure $navigationIcon = 'heroicon-o-heart';

    protected string | Closure | null $navigationLabel = null;

    public function register(Panel $panel): void
    {
        $panel->pages([$this->getPage()]);
    }

    public function boot(Panel $panel): void
    {
        //
    }

    public function authorize(bool | Closure $callback = true): static
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
        $instance = filament('filament-spatie-health');

        if (! $instance instanceof static) {
            throw new LogicException('The Filament Spatie Laravel Health plugin is not registered on the current panel.');
        }

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

    /** @param class-string<Page> $page */
    public function usingPage(string $page): static
    {
        $this->page = $page;

        return $this;
    }

    /** @return class-string<Page> */
    public function getPage(): string
    {
        return $this->page;
    }

    public function navigationGroup(string | UnitEnum | Closure | null $navigationGroup): static
    {
        $this->navigationGroup = $navigationGroup;
        $this->navigationGroupSet = true;

        return $this;
    }

    public function getNavigationGroup(): string | UnitEnum | null
    {
        $navigationGroup = $this->evaluate($this->navigationGroup);

        if (! is_string($navigationGroup) && ! $navigationGroup instanceof UnitEnum && $navigationGroup !== null) {
            throw new LogicException('The navigation group must resolve to a string, enum, or null.');
        }

        if ($navigationGroup === null && $this->navigationGroupSet === false) {
            return __('filament-spatie-health::health.pages.health_check_results.navigation.group');
        }

        return $navigationGroup;
    }

    public function navigationSort(int | Closure $navigationSort): static
    {
        $this->navigationSort = $navigationSort;

        return $this;
    }

    public function getNavigationSort(): int
    {
        $navigationSort = $this->evaluate($this->navigationSort);

        if (! is_int($navigationSort)) {
            throw new LogicException('The navigation sort must resolve to an integer.');
        }

        return $navigationSort;
    }

    public function navigationIcon(string | Closure $navigationIcon): static
    {
        $this->navigationIcon = $navigationIcon;

        return $this;
    }

    public function getNavigationIcon(): string
    {
        $navigationIcon = $this->evaluate($this->navigationIcon);

        if (! is_string($navigationIcon)) {
            throw new LogicException('The navigation icon must resolve to a string.');
        }

        return $navigationIcon;
    }

    public function navigationLabel(string | Closure | null $navigationLabel): static
    {
        $this->navigationLabel = $navigationLabel;

        return $this;
    }

    public function getNavigationLabel(): string
    {
        $navigationLabel = $this->evaluate($this->navigationLabel);

        if (! is_string($navigationLabel) && $navigationLabel !== null) {
            throw new LogicException('The navigation label must resolve to a string or null.');
        }

        return $navigationLabel ?? __('filament-spatie-health::health.pages.health_check_results.navigation.label');
    }
}
