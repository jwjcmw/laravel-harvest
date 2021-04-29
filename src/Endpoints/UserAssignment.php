<?php

namespace Byte5\LaravelHarvest\Endpoints;

class UserAssignment extends BaseEndpoint
{
    /**
     * @return mixed
     */
    protected function getPath()
    {
        return ($this->baseId) ? 'projects/{ID}/user_assignments' : 'user_assignments';
    }

    /**
     * @return mixed
     */
    public function getModel()
    {
        return \Byte5\LaravelHarvest\Models\UserAssignment::class;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function fromProject($id)
    {
        $this->baseId = $id;
    }
}
