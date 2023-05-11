<?php

namespace Byte5\LaravelHarvest\Endpoints;

use Carbon\Carbon;

class Invoice extends BaseEndpoint
{
    protected function getPath(): string
    {
        return 'invoices';
    }

    public function getModel(): string
    {
        return \Byte5\LaravelHarvest\Models\Invoice::class;
    }

    public function client(int $id): void
    {
        $this->params += ['client_id' => $id];
    }

    public function project(int $id): void
    {
        $this->params += ['project_id' => $id];
    }

    public function state(string $state): void
    {
        $this->params += ['state' => match($state) {
            'draft' => 'draft',
            'open' => 'open',
            'paid' => 'paid',
            'closed' => 'closed'
        }];
    }

    public function updatedSince(string|Carbon $dateTime): void
    {
        if (! $dateTime instanceof Carbon) {
            $dateTime = Carbon::parse($dateTime);
        }

        $this->params += ['updated_since' => $dateTime->toIso8601ZuluString()];
    }

    public function from(string|Carbon $date): void
    {
        if (! $date instanceof Carbon) {
            $date = Carbon::parse($date);
        }

        $this->params += ['from' => $date->format('Y-m-d')];
    }

    public function to(string|Carbon $date): void
    {
        if (! $date instanceof Carbon) {
            $date = Carbon::parse($date);
        }

        $this->params += ['to' => $date->format('Y-m-d')];
    }
}
