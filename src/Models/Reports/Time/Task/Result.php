<?php

namespace Byte5\LaravelHarvest\Models\Reports\Time\Task;

use Byte5\LaravelHarvest\Models\Task;
use Byte5\LaravelHarvest\Traits\HasExternalRelations;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasExternalRelations;

    protected $fillable = [
        'external_task_id',
        'task_name',
        'total_hours',
        'billable_hours',
        'currency',
        'billable_amount',
    ];

    protected function getExternalRelations(): array
    {
        return ['task'];
    }

    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
