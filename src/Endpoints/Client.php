<?php

namespace Byte5\LaravelHarvest\Endpoints;

use Carbon\Carbon;

class Client extends BaseEndpoint
{
    protected function getPath(): string
    {
        return 'clients';
    }

    public function getModel(): string
    {
        return \Byte5\LaravelHarvest\Models\Client::class;
    }

    public function updatedSince(Carbon|string $dateTime): void
    {
        if (! $dateTime instanceof Carbon) {
            $dateTime = Carbon::parse($dateTime);
        }

        $this->params += ['updated_since' => $dateTime->toIso8601ZuluString()];
    }
}
