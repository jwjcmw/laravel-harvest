<?php

namespace Byte5\LaravelHarvest\Transformer;

use Byte5\LaravelHarvest\Contracts\Transformer;
use Byte5\LaravelHarvest\Models\TimeEntry as TimeEntryModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class TimeEntry implements Transformer
{
    public function transformModelAttributes(array $data): Model
    {
        $timeEntry = new TimeEntryModel;

        if (config('harvest.uses_database')) {
            $timeEntry = $timeEntry->firstOrNew(['external_id' => $data['id']]);
        }

        $timeEntry->external_id = $data['id'];
        $timeEntry->external_reference = $data['external_reference'];
        $timeEntry->hours = $data['hours'];
        $timeEntry->billable_rate = $data['billable_rate'];
        $timeEntry->cost_rate = $data['cost_rate'];
        $timeEntry->notes = $data['notes'];
        $timeEntry->is_locked = $data['is_locked'];
        $timeEntry->locked_reason = $data['locked_reason'];
        $timeEntry->is_closed = $data['is_closed'];
        $timeEntry->is_billed = $data['is_billed'];
        $timeEntry->is_running = $data['is_running'];
        $timeEntry->billable = $data['billable'];
        $timeEntry->budgeted = $data['budgeted'];
        $timeEntry->started_time = $data['started_time'];
        $timeEntry->ended_time = $data['ended_time'];
        $timeEntry->spent_date = $data['spent_date'];
        $timeEntry->timer_started_at = $data['timer_started_at'];

        $timeEntry->external_user_id = Arr::get($data, 'user.id');
        $timeEntry->external_user_assignment_id = Arr::get($data, 'user_assignment.id');
        $timeEntry->external_client_id = Arr::get($data, 'client.id');
        $timeEntry->external_project_id = Arr::get($data, 'project.id');
        $timeEntry->external_task_id = Arr::get($data, 'task.id');
        $timeEntry->external_task_assignment_id = Arr::get($data, 'task_assignment.id');
        $timeEntry->external_invoice_id = Arr::get($data, 'invoice.id');

        return $timeEntry;
    }
}
