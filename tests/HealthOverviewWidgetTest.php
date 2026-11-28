<?php

namespace ShuvroRoy\FilamentSpatieLaravelHealth\Tests;

use BladeUI\Heroicons\BladeHeroiconsServiceProvider;
use BladeUI\Icons\BladeIconsServiceProvider;
use Filament\Actions\ActionsServiceProvider;
use Filament\Facades\Filament;
use Filament\Panel;
use Filament\Schemas\SchemasServiceProvider;
use Filament\Support\SupportServiceProvider;
use Filament\Widgets\WidgetsServiceProvider;
use Illuminate\Contracts\Console\Kernel;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Livewire\Livewire;
use PHPUnit\Framework\Attributes\DataProvider;
use ShuvroRoy\FilamentSpatieLaravelHealth\FilamentSpatieLaravelHealthPlugin;
use ShuvroRoy\FilamentSpatieLaravelHealth\Pages\HealthCheckResults;
use ShuvroRoy\FilamentSpatieLaravelHealth\Widgets\HealthOverviewWidget;
use Spatie\Health\Models\HealthCheckResultHistoryItem;
use Spatie\Health\ResultStores\EloquentHealthResultStore;
use Spatie\Health\ResultStores\ResultStore;
use Spatie\Health\ResultStores\StoredCheckResults\StoredCheckResult;
use Spatie\Health\ResultStores\StoredCheckResults\StoredCheckResults;

class OperationsHealthPage extends HealthCheckResults {}

class DemoHistoryItem extends HealthCheckResultHistoryItem
{
    protected $table = 'custom_health_history';

    protected $primaryKey = 'history_key';
}

class HealthOverviewWidgetTest extends TestCase
{
    protected function getPackageProviders($app): array
    {
        return [
            ...parent::getPackageProviders($app),
            BladeIconsServiceProvider::class,
            BladeHeroiconsServiceProvider::class,
            SupportServiceProvider::class,
            ActionsServiceProvider::class,
            SchemasServiceProvider::class,
            WidgetsServiceProvider::class,
        ];
    }

    protected function setUp(): void
    {
        parent::setUp();
        config()->set('app.key', str_repeat('x', 32));

        $plugin = FilamentSpatieLaravelHealthPlugin::make()->dashboardWidget()->usingPage(OperationsHealthPage::class);
        $panel = Panel::make()->id('operations')->plugin($plugin);
        Filament::setCurrentPanel($panel);
        Route::name('filament.operations.')->prefix('operations')->group(fn () => OperationsHealthPage::registerRoutes($panel));
        Route::getRoutes()->refreshNameLookups();
    }

    private function storeResults(?StoredCheckResults $results): void
    {
        $store = $this->createMock(ResultStore::class);
        $store->expects(self::never())->method('save');
        $store->method('latestResults')->willReturn($results);
        app()->instance(ResultStore::class, $store);
    }

    public function test_widget_links_to_matching_results_and_the_filter_can_be_cleared(): void
    {
        $results = new StoredCheckResults(now()->subMinutes(3));
        foreach (['Disk' => 'warning', 'Redis' => 'failed', 'DB' => 'failed', 'Queue' => 'crashed', 'Backups' => 'skipped', 'Cache' => 'ok'] as $label => $status) {
            $results->addCheck(new StoredCheckResult($label, $label, status: $status));
        }
        $this->storeResults($results);

        Livewire::test(HealthOverviewWidget::class)
            ->assertSee('Latest run')->assertSee('1 passing')->assertDontSee('health-run-bars')
            ->assertSee('Needs attention (5)')->assertSee('All checks (6)')
            ->assertSee('2 failed')->assertSee('1 warning')->assertSee('1 crashed')->assertSee('1 skipped')
            ->assertSee('3 minutes ago')
            ->assertSee(OperationsHealthPage::getUrl(['needsAttention' => 1]));

        Livewire::withQueryParams(['needsAttention' => '1'])->test(OperationsHealthPage::class)
            ->assertSet('needsAttention', true)
            ->assertSee('Disk')->assertSee('Redis')->assertSee('Queue')->assertSee('Backups')->assertDontSeeText('Cache')
            ->set('needsAttention', false)->assertSeeText('Cache');
    }

    public function test_history_chart_uses_the_configured_model_and_latest_twelve_batches_in_run_order(): void
    {
        config()->set('health.result_stores', [EloquentHealthResultStore::class => ['model' => DemoHistoryItem::class]]);
        config()->set('health.treat_skipped_as_failure', false);
        $migration = require dirname(__DIR__) . '/vendor/spatie/laravel-health/database/migrations/create_health_tables.php.stub';
        self::assertIsObject($migration);
        self::assertTrue(is_callable([$migration, 'up']));
        $migration->up();
        Schema::table('custom_health_history', fn (Blueprint $table) => $table->renameColumn('id', 'history_key'));

        $day = now()->startOfDay();
        for ($run = 1; $run <= 13; $run++) {
            // The two oldest runs tie at the chart boundary.
            $time = $day->copy()->addMinutes(max(2, $run));
            $batch = sprintf('00000000-0000-0000-0000-%012d', $run);
            foreach (['Database' => 'ok', 'Disk' => $run % 2 ? 'warning' : 'ok', 'Queue' => 'skipped'] as $name => $status) {
                DemoHistoryItem::create([
                    'batch' => $batch, 'check_name' => $name, 'check_label' => $name, 'status' => $status,
                    'short_summary' => "{$name} from run {$run}", 'meta' => [], 'ended_at' => $time, 'created_at' => $time,
                ]);
            }

            if ($run === 1) {
                Livewire::test(HealthOverviewWidget::class)->assertSee('Latest run')->assertDontSee('health-run-bars');
            }
        }

        // One run spans more than twelve timestamps. An older check still belongs to run two.
        $row = DemoHistoryItem::query()->where('batch', $batch)->where('status', 'ok')->firstOrFail()->getAttributes();
        unset($row['history_key']);
        for ($minute = 14; $minute <= 26; $minute++) {
            $row['created_at'] = $day->copy()->addMinutes($minute);
            DemoHistoryItem::query()->insert($row);
        }
        $row['batch'] = '00000000-0000-0000-0000-000000000002';
        $row['created_at'] = $day->copy()->subDay();
        DemoHistoryItem::query()->insert($row);

        DB::enableQueryLog();
        $chart = Livewire::test(HealthOverviewWidget::class);
        $aggregate = collect(DB::getQueryLog())->first(fn (array $query): bool => str_contains($query['query'], 'AS attention_count'));
        self::assertNotNull($aggregate);
        self::assertContains($row['batch'], $aggregate['bindings']);
        self::assertNotContains('00000000-0000-0000-0000-000000000001', $aggregate['bindings']);
        $chart->assertSee('Last 12 runs')->assertDontSee('Latest run')
            ->assertDontSee('health-run-00000000-0000-0000-0000-000000000001')
            ->assertSeeInOrder(['health-run-00000000-0000-0000-0000-000000000002', 'Needs attention 0/4', 'health-run-00000000-0000-0000-0000-000000000003', 'Needs attention 1/3']);
        self::assertSame(12, substr_count($chart->html(), 'class="health-run-bar"'));

        $batch = '00000000-0000-0000-0000-000000000003';
        $params = ['run' => $batch, 'needsAttention' => 1];
        $chart->assertSee(OperationsHealthPage::getUrl($params));
        $page = Livewire::withQueryParams($params)->test(OperationsHealthPage::class);
        $page->assertSee('Saved run')->assertSee($day->copy()->addMinutes(3)->isoFormat('LLL'))
            ->assertSee('Back to latest')->assertDontSeeText('Refresh')
            ->assertSee('Disk from run 3')->assertDontSee('Database from run 3')->assertDontSee('Disk from run 13')
            ->set('needsAttention', false)->assertSee('Database from run 3')->assertSet('run', $batch);
        $kernel = $this->createMock(Kernel::class);
        $kernel->expects(self::never())->method('call');
        Artisan::swap($kernel);
        $page->call('refresh')->assertSee('Saved run');
        DemoHistoryItem::query()->where('batch', $batch)->delete();
        $page->call('$refresh')->assertSee('This run is no longer available.')->assertDontSee('Disk from run 13');

        Livewire::withQueryParams(['run' => 'invalid'])->test(OperationsHealthPage::class)
            ->assertSee('This run is no longer available.');
    }

    public function test_a_saved_run_url_on_a_latest_only_store_does_not_display_current_results(): void
    {
        $store = $this->createMock(ResultStore::class);
        $store->expects(self::never())->method('latestResults');
        app()->instance(ResultStore::class, $store);

        Livewire::withQueryParams(['run' => '00000000-0000-0000-0000-000000000001'])->test(OperationsHealthPage::class)
            ->assertSee('This run is no longer available.')->assertSee('Back to latest');
    }

    /** @return array<string, array{string|list<string>}> */
    public static function malformedRunSelectors(): array
    {
        return [
            'array' => [['invalid']],
            'empty' => [''],
        ];
    }

    /** @param string|list<string> $selector */
    #[DataProvider('malformedRunSelectors')]
    public function test_a_malformed_run_never_reads_latest_results(string | array $selector): void
    {
        $store = $this->createMock(ResultStore::class);
        $store->expects(self::never())->method('latestResults');
        app()->instance(ResultStore::class, $store);

        Livewire::withQueryParams(['run' => $selector])->test(OperationsHealthPage::class)
            ->assertSee('This run is no longer available.')->assertSee('Back to latest')->assertDontSeeText('Refresh')
            ->call('$refresh')->assertSee('This run is no longer available.');
    }

    public function test_skipped_checks_can_be_excluded_from_the_widget_and_filter(): void
    {
        config()->set('health.treat_skipped_as_failure', false);
        $this->storeResults((new StoredCheckResults)->addCheck(new StoredCheckResult('Optional', 'Optional', status: 'skipped')));

        Livewire::test(HealthOverviewWidget::class)
            ->assertSee('No checks need attention.')->assertSee(OperationsHealthPage::getUrl());
        Livewire::test(OperationsHealthPage::class)->assertSeeText('Optional')
            ->set('needsAttention', true)->assertDontSeeText('Optional')->assertSee('No checks need attention.');
    }

    public function test_widget_previews_two_checks_per_status_in_severity_order_and_picks_up_new_results(): void
    {
        $results = new StoredCheckResults;
        $results->addCheck(new StoredCheckResult('Disk', 'Disk space', shortSummary: '86% used', status: 'warning'));
        $results->addCheck(new StoredCheckResult('Redis', 'Redis connection', 'Connection refused', 'Failed', 'failed'));
        $results->addCheck(new StoredCheckResult('Database', status: 'failed'));
        $results->addCheck(new StoredCheckResult('Queue', 'Background queue', status: 'failed'));
        $results->addCheck(new StoredCheckResult('Backups', 'Offsite backups', status: 'crashed'));
        $this->storeResults($results);

        $widget = Livewire::test(HealthOverviewWidget::class);
        $widget->assertSeeInOrder(['Offsite backups', '3 failed', 'Redis connection', 'Connection refused', 'Database', 'Disk space', '86% used'])
            ->assertDontSeeText('Background queue')
            ->assertSee('wire:poll.visible.60s', false);

        $results->storedCheckResults = $results->storedCheckResults->where('name', 'Queue');
        $widget->call('$refresh')->assertSee('1 failed')->assertSee('Needs attention (1)')->assertSee('Background queue')->assertDontSeeText('Connection refused');
    }

    public function test_widget_and_page_handle_a_store_with_no_results(): void
    {
        $this->storeResults(null);

        Livewire::test(HealthOverviewWidget::class)->assertSee('No check results available yet.')->assertDontSee('Check results from');
        Livewire::test(OperationsHealthPage::class)->assertSee('No check results available yet.')->assertDontSee('Latest run');
    }

    public function test_unauthorized_users_cannot_read_the_widget(): void
    {
        FilamentSpatieLaravelHealthPlugin::get()->authorize(false);
        $store = $this->createMock(ResultStore::class);
        $store->expects(self::never())->method('latestResults');
        app()->instance(ResultStore::class, $store);

        self::assertFalse(HealthOverviewWidget::canView());
        Livewire::test(HealthOverviewWidget::class)->assertForbidden();
        Livewire::withQueryParams(['run' => '00000000-0000-0000-0000-000000000001'])->test(OperationsHealthPage::class)
            ->assertForbidden();
    }

    public function test_widget_respects_the_custom_pages_access_rule(): void
    {
        $page = new class extends HealthCheckResults
        {
            public static function canAccess(): bool
            {
                return false;
            }
        };
        FilamentSpatieLaravelHealthPlugin::get()->usingPage($page::class);

        self::assertFalse(HealthOverviewWidget::canView());
    }
}
