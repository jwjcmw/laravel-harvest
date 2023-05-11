<?php

namespace Byte5\LaravelHarvest\Endpoints;

class Expense extends BaseEndpoint
{
    protected function getPath(): string
    {
        return 'expenses';
    }

    public function getModel(): string
    {
        return \Byte5\LaravelHarvest\Models\Expense::class;
    }
}
