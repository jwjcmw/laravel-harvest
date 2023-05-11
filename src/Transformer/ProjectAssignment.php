<?php

namespace Byte5\LaravelHarvest\Transformer;

use Byte5\LaravelHarvest\Contracts\Transformer;
use Byte5\LaravelHarvest\Models\ProjectAssignment as ProjectAssignmentModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class ProjectAssignment implements Transformer
{
    public function transformModelAttributes(array $data): Model
    {
        $projectAssignment = new ProjectAssignmentModel;

        if (config('harvest.uses_database')) {
            $projectAssignment = $projectAssignment->firstOrNew(['external_id' => $data['id']]);
        }

        $projectAssignment->external_id = $data['id'];
        $projectAssignment->is_active = $data['is_active'];
        $projectAssignment->is_project_manager = $data['is_project_manager'];
        $projectAssignment->hourly_rate = $data['hourly_rate'];
        $projectAssignment->budget = $data['budget'];
        $projectAssignment->task_assignments = $data['task_assignments'];

        $projectAssignment->external_project_id = Arr::get($data, 'project.id');
        $projectAssignment->external_client_id = Arr::get($data, 'client.id');

        return $projectAssignment;
    }
}
