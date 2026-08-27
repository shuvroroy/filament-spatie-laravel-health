<?php

namespace ShuvroRoy\FilamentSpatieLaravelHealth\Tests;

use Carbon\Carbon;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\FilamentManager;
use Filament\Notifications\Notification;
use Filament\Panel;
use ShuvroRoy\FilamentSpatieLaravelHealth\FilamentSpatieLaravelHealthPlugin;
use ShuvroRoy\FilamentSpatieLaravelHealth\Pages\HealthCheckResults;
use Spatie\Health\ResultStores\ResultStore;
use Spatie\Health\ResultStores\StoredCheckResults\StoredCheckResults;

class TestableHealthCheckResults extends HealthCheckResults
{
    /** @return array<Action | ActionGroup> */
    public function headerActions(): array
    {
        return $this->getHeaderActions();
    }

    /** @return array<string, mixed> */
    public function viewData(): array
    {
        return $this->getViewData();
    }
}

class HealthCheckResultsTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $plugin = FilamentSpatieLaravelHealthPlugin::make();
        $panel = Panel::make()->id('test')->plugin($plugin);
        app(FilamentManager::class)->setCurrentPanel($panel);
    }

    public function test_it_uses_plugin_navigation_title_and_authorization_settings(): void
    {
        $plugin = FilamentSpatieLaravelHealthPlugin::get()->navigationGroup('Operations')->navigationLabel('Health status')->navigationSort(7)->navigationIcon('heroicon-o-signal')->authorize(false);
        $page = new HealthCheckResults;

        self::assertSame('Operations', HealthCheckResults::getNavigationGroup());
        self::assertSame('Health status', HealthCheckResults::getNavigationLabel());
        self::assertSame(7, HealthCheckResults::getNavigationSort());
        self::assertSame('heroicon-o-signal', HealthCheckResults::getNavigationIcon());
        self::assertFalse(HealthCheckResults::canAccess());
        self::assertSame('Application Health', $page->getHeading());
        self::assertSame('Health status', $page->getTitle());
        $plugin->authorize();
        self::assertTrue(HealthCheckResults::canAccess());
    }

    public function test_it_builds_its_refresh_action(): void
    {
        $actions = (new TestableHealthCheckResults)->headerActions();
        self::assertCount(1, $actions);
        self::assertInstanceOf(Action::class, $actions[0]);
        self::assertSame('Refresh', $actions[0]->getName());
    }

    public function test_it_provides_the_latest_stored_results_to_the_view(): void
    {
        $finishedAt = Carbon::parse('2026-08-27 12:00:00');
        $results = new StoredCheckResults($finishedAt);
        $store = $this->createMock(ResultStore::class);
        $store->expects(self::once())->method('latestResults')->willReturn($results);
        app()->instance(ResultStore::class, $store);
        $viewData = (new TestableHealthCheckResults)->viewData();
        self::assertSame($results, $viewData['checkResults']);
        self::assertEquals($finishedAt, $viewData['lastRanAt']);
    }

    public function test_it_handles_a_result_store_with_no_previous_run(): void
    {
        $store = $this->createMock(ResultStore::class);
        $store->expects(self::once())->method('latestResults')->willReturn(null);
        app()->instance(ResultStore::class, $store);
        $viewData = (new TestableHealthCheckResults)->viewData();
        self::assertNull($viewData['checkResults']);
        self::assertInstanceOf(Carbon::class, $viewData['lastRanAt']);
    }

    public function test_it_runs_health_checks_refreshes_itself_and_sends_a_notification(): void
    {
        $page = $this->getMockBuilder(HealthCheckResults::class)->onlyMethods(['dispatch'])->getMock();
        $page->expects(self::once())->method('dispatch')->with('refresh-component');
        $page->refresh();
        Notification::assertNotified('Health check results refreshed');
    }
}
