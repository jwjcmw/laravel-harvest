<?php

namespace Byte5\LaravelHarvest\Endpoints;

use Carbon\Carbon;

class Project extends BaseEndpoint
{
    protected function getPath(): string
    {
        return 'projects';
    }

    public function getModel(): string
    {
        return \Byte5\LaravelHarvest\Models\Project::class;
    }

    public function client(int $id)
    {
        $this->params += ['client_id' => $id];
    }

    public function updatedSince(string|Carbon $dateTime): void
    {
        if (! $dateTime instanceof Carbon) {
            $dateTime = Carbon::parse($dateTime);
        }

        $this->params += ['updated_since' => $dateTime->toIso8601ZuluString()];
    }
}
