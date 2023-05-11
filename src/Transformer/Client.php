<?php

namespace Byte5\LaravelHarvest\Transformer;

use Byte5\LaravelHarvest\Models\Client as ClientModel;
use Byte5\LaravelHarvest\Contracts\Transformer as TransformerContract;
use Illuminate\Database\Eloquent\Model;

class Client implements TransformerContract
{
    public function transformModelAttributes(array $data): Model
    {
        $client = new ClientModel;

        if (config('harvest.uses_database')) {
            $client = $client->firstOrNew(['external_id' => $data['id']]);
        }

//        var_dump($data);die;

        $client->external_id = $data['id'];
        $client->currency = $data['currency'];
        $client->name = $data['name'];
        $client->is_active = $data['is_active'];
        $client->address = $data['address'];

        return $client;
    }
}
