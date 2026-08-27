<?php

namespace ShuvroRoy\FilamentSpatieLaravelHealth\Tests;

use Filament\FilamentManager;
use Filament\Pages\Page;
use Filament\Panel;
use Filament\Support\Facades\FilamentAsset;
use LogicException;
use PHPUnit\Framework\Attributes\DataProvider;
use ShuvroRoy\FilamentSpatieLaravelHealth\FilamentSpatieLaravelHealthPlugin;
use ShuvroRoy\FilamentSpatieLaravelHealth\Pages\HealthCheckResults;

enum NavigationGroup: string
{
    case System = 'system';
}

class PluginTest extends TestCase
{
    private FilamentSpatieLaravelHealthPlugin $plugin;

    private Panel $panel;

    protected function setUp(): void
    {
        parent::setUp();
        $this->plugin = FilamentSpatieLaravelHealthPlugin::make();
        $this->panel = Panel::make()->id('test')->plugin($this->plugin);
        app(FilamentManager::class)->setCurrentPanel($this->panel);
    }

    public function test_it_registers_its_page_and_exposes_its_identity(): void
    {
        self::assertSame('filament-spatie-health', $this->plugin->getId());
        self::assertSame(HealthCheckResults::class, $this->plugin->getPage());
        self::assertContains(HealthCheckResults::class, $this->panel->getPages());
        self::assertSame($this->plugin, FilamentSpatieLaravelHealthPlugin::get());
        $this->plugin->boot($this->panel);
    }

    public function test_it_can_use_a_custom_page(): void
    {
        $page = new class extends Page
        {
            protected string $view = 'filament-spatie-health::pages.health-check-results';
        };

        self::assertSame($this->plugin, $this->plugin->usingPage($page::class));
        self::assertSame($page::class, $this->plugin->getPage());
    }

    public function test_it_configures_navigation_with_values_and_closures(): void
    {
        self::assertSame('Settings', $this->plugin->getNavigationGroup());
        self::assertSame(1, $this->plugin->getNavigationSort());
        self::assertSame('heroicon-o-heart', $this->plugin->getNavigationIcon());
        self::assertSame('Application Health', $this->plugin->getNavigationLabel());

        $configured = $this->plugin
            ->navigationGroup(fn (): NavigationGroup => NavigationGroup::System)
            ->navigationSort(fn (): int => 10)
            ->navigationIcon(fn (): string => 'heroicon-o-cog')
            ->navigationLabel(fn (): string => 'Status');

        self::assertSame($this->plugin, $configured);
        self::assertSame(NavigationGroup::System, $this->plugin->getNavigationGroup());
        self::assertSame(10, $this->plugin->getNavigationSort());
        self::assertSame('heroicon-o-cog', $this->plugin->getNavigationIcon());
        self::assertSame('Status', $this->plugin->getNavigationLabel());
        self::assertNull($this->plugin->navigationGroup(null)->getNavigationGroup());
        self::assertSame('Application Health', $this->plugin->navigationLabel(null)->getNavigationLabel());
    }

    public function test_it_authorizes_access_with_values_and_closures(): void
    {
        self::assertTrue($this->plugin->isAuthorized());
        self::assertSame($this->plugin, $this->plugin->authorize(false));
        self::assertFalse($this->plugin->isAuthorized());
        self::assertTrue($this->plugin->authorize(fn (): bool => true)->isAuthorized());
    }

    public function test_it_registers_its_stylesheet_as_an_on_demand_asset(): void
    {
        $styles = FilamentAsset::getStyles(['filament-spatie-health']);
        self::assertCount(1, $styles);
        self::assertSame('filament-spatie-health-styles', $styles[0]->getId());
        self::assertStringEndsWith('/resources/dist/plugin.css', (string) $styles[0]->getPath());
        self::assertTrue($styles[0]->isLoadedOnRequest());
    }

    /** @return iterable<string, array{callable(FilamentSpatieLaravelHealthPlugin): mixed, callable(FilamentSpatieLaravelHealthPlugin): mixed}> */
    public static function invalidClosureProviders(): iterable
    {
        yield 'navigation group' => [fn (FilamentSpatieLaravelHealthPlugin $plugin) => $plugin->navigationGroup(fn () => []), fn (FilamentSpatieLaravelHealthPlugin $plugin) => $plugin->getNavigationGroup()];
        yield 'navigation sort' => [fn (FilamentSpatieLaravelHealthPlugin $plugin) => $plugin->navigationSort(fn () => []), fn (FilamentSpatieLaravelHealthPlugin $plugin) => $plugin->getNavigationSort()];
        yield 'navigation icon' => [fn (FilamentSpatieLaravelHealthPlugin $plugin) => $plugin->navigationIcon(fn () => []), fn (FilamentSpatieLaravelHealthPlugin $plugin) => $plugin->getNavigationIcon()];
        yield 'navigation label' => [fn (FilamentSpatieLaravelHealthPlugin $plugin) => $plugin->navigationLabel(fn () => []), fn (FilamentSpatieLaravelHealthPlugin $plugin) => $plugin->getNavigationLabel()];
    }

    /**
     * @param  callable(FilamentSpatieLaravelHealthPlugin): mixed  $configure
     * @param  callable(FilamentSpatieLaravelHealthPlugin): mixed  $read
     */
    #[DataProvider('invalidClosureProviders')]
    public function test_it_rejects_invalid_closure_results(callable $configure, callable $read): void
    {
        $configure($this->plugin);
        $this->expectException(LogicException::class);
        $read($this->plugin);
    }

    public function test_it_fails_clearly_when_the_plugin_is_not_registered(): void
    {
        app(FilamentManager::class)->setCurrentPanel(Panel::make()->id('empty'));
        $this->expectException(LogicException::class);
        $this->expectExceptionMessage('not registered');
        FilamentSpatieLaravelHealthPlugin::get();
    }
}
