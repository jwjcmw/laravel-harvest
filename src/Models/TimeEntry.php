<?php

namespace Byte5\LaravelHarvest\Models;

use Illuminate\Database\Eloquent\Model;
use Byte5\LaravelHarvest\Traits\HasExternalRelations;

class TimeEntry extends Model
{
    use HasExternalRelations;

    protected $casts = [
        'external_reference' => 'object',
        'is_locked' => 'boolean',
        'is_closed' => 'boolean',
        'is_billed' => 'boolean',
        'is_running' => 'boolean',
        'billable' => 'boolean',
        'budgeted' => 'boolean',
    ];
    protected $dates = [
        'created_at', 'updated_at', 'spent_date', 'timer_started_at',
    ];
    protected $fillable = [
        'external_id', 'user_id', 'user_assignment_id', 'client_id', 'project_id', 'task_id',
        'task_assignment_id', 'invoice_id', 'reference', 'hours', 'billable_rate', 'cost_rate',
        'notes', 'is_locked', 'locked_reason', 'is_closed', 'is_billed', 'is_running',
        'billable', 'budgeted', 'started_time', 'ended_time', 'spent_date',
        'timer_started_at',
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable(
            config('harvest.table_prefix').config('harvest.table_names.time_entries')
        );
    }

    protected function getExternalRelations(): array
    {
        return [
            'user',
            'client',
            'invoice',
            'project',
            'task',
//            'taskAssignment',
//            'userAssignment',
        ];
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function taskAssignment()
    {
        return $this->belongsTo(TaskAssignment::class);
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
