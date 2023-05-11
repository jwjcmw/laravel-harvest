<?php

namespace Byte5\LaravelHarvest\Endpoints;

class ProjectAssignment extends BaseEndpoint
{
    protected function getPath(): string
    {
        return 'users/{USER_ID}/project_assignments';
    }

    public function getModel(): string
    {
        return \Byte5\LaravelHarvest\Models\ProjectAssignment::class;
    }

    public function fromUser(int $id): void
    {
        $this->baseId = $id;
    }
}
