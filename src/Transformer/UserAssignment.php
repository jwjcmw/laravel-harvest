<?php

namespace Byte5\LaravelHarvest\Transformer;

use Byte5\LaravelHarvest\Contracts\Transformer;
use Byte5\LaravelHarvest\Models\UserAssignment as UserAssignmentModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class UserAssignment implements Transformer
{
    public function transformModelAttributes(array $data): Model
    {
        $userAssignment = new UserAssignmentModel;

        if (config('harvest.uses_database')) {
            $userAssignment = $userAssignment->firstOrNew(['external_id' => $data['id']]);
        }

        $userAssignment->external_id = $data['id'];
        $userAssignment->is_active = $data['is_active'];
        $userAssignment->is_project_manager = $data['is_project_manager'];
        $userAssignment->hourly_rate = $data['hourly_rate'];
        $userAssignment->budget = $data['budget'];

        $userAssignment->external_user_id = Arr::get($data, 'user.id');

        return $userAssignment;
    }
}
