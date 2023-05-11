<?php

namespace Byte5\LaravelHarvest\Endpoints;

class Company extends BaseEndpoint
{
    protected function getPath(): string
    {
        return 'company';
    }

    public function getModel(): string
    {
        return \Byte5\LaravelHarvest\Models\Company::class;
    }
}
