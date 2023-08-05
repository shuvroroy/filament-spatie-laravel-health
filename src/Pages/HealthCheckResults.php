<?php

namespace ShuvroRoy\FilamentSpatieLaravelHealth\Pages;

use Carbon\Carbon;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\Artisan;
use Spatie\Health\Commands\RunHealthChecksCommand;
use Spatie\Health\ResultStores\ResultStore;
use Filament\Contracts\Plugin;

class HealthCheckResults extends Page implements Plugin
{
    public static function make() : static
    {
        return app( static::class);
    }
    /**
     * @var array<string, string>
     */
    protected $listeners = ['refresh-component' => '$refresh'];

    protected static ?string $navigationIcon = 'heroicon-o-heart';

    protected static string $view = 'filament-spatie-health::pages.health-check-results';

    protected function getActions() : array
    {
        return [
            Action::make( __( 'filament-spatie-health::health.pages.health_check_results.buttons.refresh' ) )
                ->button()
                ->action( 'refresh' ),
        ];
    }

    public function getHeading() : string|Htmlable
    {
        return __( 'filament-spatie-health::health.pages.health_check_results.heading' );
    }

    public static function getNavigationGroup() : ?string
    {
        return __( 'filament-spatie-health::health.pages.health_check_results.navigation.group' );
    }

    public static function getNavigationLabel() : string
    {
        return __( 'filament-spatie-health::health.pages.health_check_results.navigation.label' );
    }

    protected function getViewData() : array
    {
        $checkResults = app( ResultStore::class)->latestResults();

        return [
            'lastRanAt'    => new Carbon( $checkResults?->finishedAt ),
            'checkResults' => $checkResults,
        ];
    }

    public function refresh() : void
    {
        Artisan::call( RunHealthChecksCommand::class);

        $this->dispatch( 'refresh-component' );

        Notification::make()
            ->title( 'Health check results refreshed' )
            ->success()
            ->send();
    }
    /**
     * @param \Filament\Panel $panel
     */
    public function register(\Filament\Panel $panel) : void
    {
        $panel->pages( [
            static::class,
        ] );
    }

    /**
     *
     * @param \Filament\Panel $panel
     */
    public function boot(\Filament\Panel $panel) : void
    {
    }

    public function getId() : string
    {
        return 'filament-spatie-health';
    }
}
