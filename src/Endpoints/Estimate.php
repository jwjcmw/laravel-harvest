<?php

namespace Byte5\LaravelHarvest\Endpoints;

class Estimate extends BaseEndpoint
{
    protected function getPath(): string
    {
        return 'estimates';
    }

    public function getModel(): string
    {
        return \Byte5\LaravelHarvest\Models\Estimate::class;
    }
}
