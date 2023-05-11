<?php

namespace Byte5\LaravelHarvest\Endpoints;

class Task extends BaseEndpoint
{
    protected function getPath(): string
    {
        return 'tasks';
    }

    /**
     * @return mixed
     */
    public function getModel(): string
    {
        return \Byte5\LaravelHarvest\Models\Task::class;
    }
}
