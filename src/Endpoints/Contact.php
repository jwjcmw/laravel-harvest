<?php

namespace Byte5\LaravelHarvest\Endpoints;

use Carbon\Carbon;

class Contact extends BaseEndpoint
{
    /**
     * @return mixed
     */
    protected function getPath()
    {
        return 'contacts';
    }

    /**
     * @return mixed
     */
    public function getModel()
    {
        return \Byte5\LaravelHarvest\Models\Contact::class;
    }

    /**
     * @param $id
     */
    public function client($id)
    {
        $this->params += ['client_id' => $id];
    }

}
