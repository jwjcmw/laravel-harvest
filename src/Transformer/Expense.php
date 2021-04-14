<?php

namespace Byte5\LaravelHarvest\Transformer;

use Byte5\LaravelHarvest\Contracts\Transformer;
use Byte5\LaravelHarvest\Models\Expense as ExpenseModel;

class Expense implements Transformer
{
    /**
     * @param $data
     * @return mixed
     */
    public function transformModelAttributes($data)
    {
        $expense = new ExpenseModel;

        if (config('harvest.uses_database')) {
            $expense = $expense->firstOrNew(['external_id' => $data['id']]);
        }

        $expense->external_id = $data['id'];
        $expense->receipt = $data['receipt'];
        $expense->notes = $data['notes'];
        $expense->billable = $data['billable'];
        $expense->is_closed = $data['is_closed'];
        $expense->is_locked = $data['is_locked'];
        $expense->is_billed = $data['is_billed'];
        $expense->locked_reason = $data['locked_reason'];
        $expense->spent_date = $data['spent_date'];

        $expense->external_client_id = \Illuminate\Support\Arr::get($data, 'client.id');
        $expense->external_project_id = \Illuminate\Support\Arr::get($data, 'project.id');
        $expense->external_expense_category_id = \Illuminate\Support\Arr::get($data, 'expense_category.id');
        $expense->external_user_id = \Illuminate\Support\Arr::get($data, 'user.id');
        $expense->external_user_assignment_id = \Illuminate\Support\Arr::get($data, 'user_assignment.id');
        $expense->external_invoice_id = \Illuminate\Support\Arr::get($data, 'invoice.id');

        return $expense;
    }
}
