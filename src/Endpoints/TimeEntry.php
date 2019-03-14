<?php

namespace Byte5\LaravelHarvest\Endpoints;

class TimeEntry extends BaseEndpoint
{
    /**
     * @return mixed
     */
    protected function getPath()
    {
        return 'time_entries';
    }

    /**
     * @return mixed
     */
    public function getModel()
    {
        return \Byte5\LaravelHarvest\Models\TimeEntry::class;
    }

    /**
     * @param $date
     */
    public function from($date)
    {
        if (! $date instanceof Carbon) {
            $date = Carbon::parse($date);
        }

        $this->params += ['from' => $date->format('Y-m-d')];
    }

    /**
     * @param $date
     */
    public function to($date)
    {
        if (! $date instanceof Carbon) {
            $date = Carbon::parse($date);
        }

        $this->params += ['to' => $date->format('Y-m-d')];
    }

    /**
     * @param $date
     */
    public function updatedSince($date)
    {
        if (! $date instanceof Carbon) {
            $date = Carbon::parse($date);
        }

        $this->params += ['updated_since' => $date->format('Y-m-d')];
    }

    /**
     * @param $isBilled
     */
    public function isBilled(bool $isBilled)
    {
        $this->params += ['is_billed' => $isBilled];
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
