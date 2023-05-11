<?php

namespace Byte5\LaravelHarvest\Endpoints;

class ExpenseCategory extends BaseEndpoint
{
    protected function getPath(): string
    {
        return 'expense_categories';
    }

    public function getModel(): string
    {
        return \Byte5\LaravelHarvest\Models\ExpenseCategory::class;
    }
}
