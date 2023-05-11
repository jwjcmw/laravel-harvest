<?php

namespace Byte5\LaravelHarvest\Models;

use Illuminate\Database\Eloquent\Model;
use Byte5\LaravelHarvest\Traits\HasExternalRelations;

class Expense extends Model
{
    use HasExternalRelations;

    protected $casts = [
        'receipt' => 'object',
        'billable' => 'boolean',
        'is_closed' => 'boolean',
        'is_locked' => 'boolean',
        'is_billed' => 'boolean',
    ];
    protected $dates = ['created_at', 'updated_at', 'spent_date'];
    protected $fillable = [
        'external_id', 'client_id', 'project_id', 'expense_category_id', 'user_id',
        'invoice_id', 'receipt', 'notes', 'billable', 'is_closed', 'external_user_id',
        'is_locked', 'is_billed', 'locked_reason', 'spent_date',
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable(
            config('harvest.table_prefix').config('harvest.table_names.expenses')
        );
    }

    protected function getExternalRelations(): array
    {
        return [
            'client',
            'project',
            'expenseCategory',
            'user',
            'invoice',
        ];
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function expenseCategory()
    {
        return $this->belongsTo(ExpenseCategory::class);
    }

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function userAssignment()
    {
        return $this->belongsTo(UserAssignment::class);
    }
}
