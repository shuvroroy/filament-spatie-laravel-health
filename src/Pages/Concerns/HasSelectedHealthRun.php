<?php

namespace ShuvroRoy\FilamentSpatieLaravelHealth\Pages\Concerns;

use Illuminate\Http\Request;
use Livewire\Attributes\Locked;

trait HasSelectedHealthRun
{
    #[Locked]
    public ?string $run = null;

    public function mountHasSelectedHealthRun(Request $request): void
    {
        if ($request->query->has('run')) {
            $selector = $request->query('run');
            // Null denotes the latest results. A present but malformed selector stays in saved-run mode.
            $this->run = is_string($selector) ? $selector : '';
        }
    }
}
