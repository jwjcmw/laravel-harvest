<?php

namespace Byte5\LaravelHarvest\Endpoints;

use Carbon\Carbon;

class TimeEntry extends BaseEndpoint
{
    protected function getPath(): string
    {
        return 'time_entries';
    }

    public function getModel(): string
    {
        return \Byte5\LaravelHarvest\Models\TimeEntry::class;
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

    public function updatedSince(string|Carbon $date): void
    {
        if (! $date instanceof Carbon) {
            $date = Carbon::parse($date);
        }

        $this->params += ['updated_since' => $date->format('Y-m-d')];
    }

    public function isBilled(bool $isBilled): void
    {
        $this->params += ['is_billed' => $isBilled ? 'true' : 'false'];
    }

    /**
     * @param $isRunning
     */
    public function isRunning(bool $isRunning)
    {
        $this->params += ['is_running' => $isRunning];
    }

    /**
     * @param $userId
     */
    public function userId(int $userId)
    {
        $this->params += ['user_id' => $userId];
    }
    
    /**
     * @param $clientId
     */
    public function clientId(int $clientId)
    {
        $this->params += ['client_id' => $clientId];
    }
    
    /**
     * @param $projectId
     */
    public function projectId(int $projectId)
    {
        $this->params += ['project_id' => $projectId];
    }
}
