<?php

namespace Byte5\LaravelHarvest\Transformer;

use Byte5\LaravelHarvest\Contracts\Transformer;
use Byte5\LaravelHarvest\Models\TaskAssignment as TaskAssignmentModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class TaskAssignment implements Transformer
{
    public function transformModelAttributes(array $data): Model
    {
        $taskAssignment = new TaskAssignmentModel;

        if (config('harvest.uses_database')) {
            $taskAssignment = $taskAssignment->firstOrNew(['external_id' => $data['id']]);
        }

        $taskAssignment->external_id = $data['id'];
        $taskAssignment->is_active = $data['is_active'];
        $taskAssignment->hourly_rate = $data['hourly_rate'];
        $taskAssignment->budget = $data['budget'];

        $taskAssignment->external_task_id = Arr::get($data, 'task.id');

        return $taskAssignment;
    }
}
