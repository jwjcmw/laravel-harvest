<?php

namespace Byte5\LaravelHarvest\Transformer;

use Byte5\LaravelHarvest\Contracts\Transformer;
use Byte5\LaravelHarvest\Models\Task as TaskModel;
use Illuminate\Database\Eloquent\Model;

class Task implements Transformer
{
    public function transformModelAttributes(array $data): Model
    {
        $task = new TaskModel;

        if (config('harvest.uses_database')) {
            $task = $task->firstOrNew(['external_id' => $data['id']]);
        }

        $task->external_id = $data['id'];
        $task->name = $data['name'];
        $task->billable_by_default = $data['billable_by_default'];
        $task->default_hourly_rate = $data['default_hourly_rate'];
        $task->is_default = $data['is_default'];
        $task->is_active = $data['is_active'];

        return $task;
    }
}
