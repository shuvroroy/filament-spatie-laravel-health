<?php

namespace ShuvroRoy\FilamentSpatieLaravelHealth\Support;

use Illuminate\Support\Collection;
use Spatie\Health\Enums\Status;
use Spatie\Health\ResultStores\StoredCheckResults\StoredCheckResult;
use Spatie\Health\ResultStores\StoredCheckResults\StoredCheckResults;

class ChecksNeedingAttention
{
    /** @return Collection<int, StoredCheckResult> */
    public static function from(?StoredCheckResults $results): Collection
    {
        if ($results === null) {
            return new Collection;
        }

        $priority = array_flip(self::statuses());

        return $results->storedCheckResults
            ->whereInStrict('status', array_keys($priority))
            ->sortBy(fn (StoredCheckResult $check): int => $priority[$check->status]);
    }

    /** @return list<int|string> */
    public static function statuses(): array
    {
        $statuses = [Status::crashed()->value, Status::failed()->value, Status::warning()->value];

        if (config('health.treat_skipped_as_failure', true)) {
            $statuses[] = Status::skipped()->value;
        }

        return $statuses;
    }
}
