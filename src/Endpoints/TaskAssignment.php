<?php

namespace Byte5\LaravelHarvest\Endpoints;

class TaskAssignment extends BaseEndpoint
{
    protected function getPath(): string
    {
        return 'projects/{id}/task_assignments';
    }

    public function getModel(): string
    {
        return \Byte5\LaravelHarvest\Models\TaskAssignment::class;
    }

    public function fromProject(int $id): void
    {
        $this->baseId = $id;
    }
}
