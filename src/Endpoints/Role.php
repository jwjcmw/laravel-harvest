<?php

namespace Byte5\LaravelHarvest\Endpoints;

class Role extends BaseEndpoint
{
    protected function getPath(): string
    {
        return 'roles';
    }

    public function getModel(): string
    {
        return \Byte5\LaravelHarvest\Models\Role::class;
    }
}
