<?php

namespace Byte5\LaravelHarvest\Endpoints;

class User extends BaseEndpoint
{
    protected function getPath(): string
    {
        return 'users';
    }

    public function getModel(): string
    {
        return \Byte5\LaravelHarvest\Models\User::class;
    }

    public function me(): array
    {
        $this->buildUrl('/me');
        return $this->get();
    }
}
