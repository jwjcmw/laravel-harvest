<?php

namespace Byte5\LaravelHarvest\Endpoints;

use Carbon\Carbon;

class ReportsUninvoiced extends BaseEndpoint
{

    protected function getPath(): string
    {
        return 'reports/uninvoiced';
    }

    public function getModel(): string
    {
        return \Byte5\LaravelHarvest\Models\ReportsUninvoiced::class;
    }

    public function from(string|Carbon $from): void
    {
        if (! $from instanceof Carbon) {
            $from = Carbon::parse($from);
        }

        $this->params += ['from' => $from->format('Y-m-d')];
    }

    public function to(string|Carbon $to): void
    {
        if (! $to instanceof Carbon) {
            $to = Carbon::parse($to);
        }

        $this->params += ['to' => $to->format('Y-m-d')];
    }
}