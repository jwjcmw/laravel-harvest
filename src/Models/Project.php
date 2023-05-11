<?php

namespace Byte5\LaravelHarvest\Models;

use Illuminate\Database\Eloquent\Model;
use Byte5\LaravelHarvest\Traits\HasExternalRelations;

class Project extends Model
{
    use HasExternalRelations;

    protected $casts = [
        'is_active' => 'boolean',
        'is_billable' => 'boolean',
        'is_fixed_fee' => 'boolean',
        'notify_when_over_budget' => 'boolean',
        'show_budget_to_all' => 'boolean',
        'cost_budget_include_expenses' => 'boolean',
    ];
    protected $dates = [
        'created_at', 'updated_at', 'over_budget_notification_date', 'starts_on', 'ends_on',
    ];
    protected $fillable = [
        'external_id', 'client_id', 'name', 'code', 'is_active', 'is_billable',
        'is_fixed_fee', 'bill_by', 'hourly_rate', 'budget', 'budget_by',
        'notify_when_over_budget', 'over_budget_notification_percentage',
        'show_budget_to_all', 'cost_budget', 'cost_budget_include_expenses',
        'fee', 'notes', 'starts_on', 'ends_on', 'over_budget_notification_date',
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable(
            config('harvest.table_prefix').config('harvest.table_names.projects')
        );
    }

    protected function getExternalRelations(): array
    {
        return ['client'];
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }

    public function timeEntries()
    {
        return $this->hasMany(TimeEntry::class);
    }

    public function getHoursAttribute()
    {
        return $this->timeEntries->sum('hours');
    }

    public function getIncomeAttribute()
    {
        return $this->expenses->reduce(
            static fn ($carry, $item) => $carry + $item->invoice->sum('amount'),
            0
        );
    }
}
