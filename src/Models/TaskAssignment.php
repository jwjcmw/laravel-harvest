<?php

namespace Byte5\LaravelHarvest\Models;

use Illuminate\Database\Eloquent\Model;
use Byte5\LaravelHarvest\Traits\HasExternalRelations;

class TaskAssignment extends Model
{
    use HasExternalRelations;

    protected $casts = [
        'is_active' => 'boolean',
        'billable' => 'boolean',
    ];
    protected $dates = ['created_at', 'updated_at'];
    protected $fillable = [
        'external_id', 'task_id', 'is_active', 'hourly_rate', 'budget',
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable(
            config('harvest.table_prefix').config('harvest.table_names.task_assignments')
        );
    }

    protected function getExternalRelations(): array
    {
        return ['task'];
    }

    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
