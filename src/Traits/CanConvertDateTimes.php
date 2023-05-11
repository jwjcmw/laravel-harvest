<?php

namespace Byte5\LaravelHarvest\Traits;

use Carbon\Carbon;
use Illuminate\Support\Collection;

trait CanConvertDateTimes
{
    protected array $carbonParseable = [
        'accepted_at',
        'closed_at',
        'created_at',
        'declined_at',
        'due_date',
        'ends_on',
        'issue_date',
        'over_budget_notification_date',
        'paid_at',
        'period_end',
        'period_start',
        'sent_at',
        'spent_date',
        'starts_on',
        'timer_started_at',
        'updated_at',
    ];

    /**
     * Converts all known datetime fields into Carbon instances.
     */
    protected function convertDateTimes(array $data): Collection
    {
        if (! $data instanceof Collection) {
            $data = collect($data);
        }

        $carbonParseable = $this->carbonParseable;
        return $data->map(
            static fn ($item) =>
                array_combine(
                    $keys = array_keys($item),
                    array_map(
                        static fn($el, $key) => null !== $el && in_array($key, $carbonParseable, true) ?
                            Carbon::parse($el)
                            : $el,
                        $item,
                        $keys
                    )
                )
        );
    }
}
