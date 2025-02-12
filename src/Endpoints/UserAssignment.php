<?php

namespace Byte5\LaravelHarvest\Endpoints;

class UserAssignment extends BaseEndpoint
{
    protected function getPath(): string
    {
       return 'user_assignments';
    }

    /**
     * @return mixed
     */
    public function getModel(): string
    {
        return \Byte5\LaravelHarvest\Models\UserAssignment::class;
    }

    public function fromProject(int $id): void
    {
        $this->baseId = $id;
    }
}
