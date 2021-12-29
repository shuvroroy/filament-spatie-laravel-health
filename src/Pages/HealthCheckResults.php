<?php

namespace ShuvroRoy\FilamentSpatieLaravelHealth\Pages;

use Carbon\Carbon;
use Filament\Pages\Actions\ButtonAction;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Artisan;
use Spatie\Health\Commands\RunHealthChecksCommand;
use Spatie\Health\ResultStores\EloquentHealthResultStore;

class HealthCheckResults extends Page
{
    protected $listeners = ['refreshComponent' => '$refresh'];

    protected static ?string $navigationGroup = 'Settings';

    protected static ?string $navigationIcon = 'heroicon-o-heart';

    protected static ?string $navigationLabel = 'Application Health';

    protected static string $view = 'filament-spatie-health::pages.health-check-results';

    protected function getHeading(): string
    {
        return 'Application Health';
    }

    protected function getViewData(): array
    {
        $checkResults = (new EloquentHealthResultStore())->latestResults();

        return [
            'lastRanAt' => new Carbon($checkResults?->finishedAt),
            'checkResults' => $checkResults,
        ];
    }

    protected function getActions(): array
    {
        return [
            ButtonAction::make('Refresh')->action('refresh'),
        ];
    }

    public function refresh(): void
    {
        Artisan::call(RunHealthChecksCommand::class);

        $this->emitSelf('refreshComponent');
    }
}
