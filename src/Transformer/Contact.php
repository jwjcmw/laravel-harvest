<?php

namespace Byte5\LaravelHarvest\Transformer;

use Byte5\LaravelHarvest\Models\Contact as ContactModel;
use Byte5\LaravelHarvest\Contracts\Transformer as TransformerContract;
use Illuminate\Database\Eloquent\Model;

class Contact implements TransformerContract
{
    public function transformModelAttributes(array $data): Model
    {
        $contact = new ContactModel;

        if (config('harvest.uses_database')) {
            $contact = $contact->firstOrNew(['external_id' => $data['id']]);
        }

        $contact->external_id = $data['id'];
        $contact->title = $data['title'];
        $contact->first_name = $data['first_name'];
        $contact->last_name = $data['last_name'];
        $contact->email = $data['email'];
        $contact->phone_office = $data['phone_office'];
        $contact->phone_mobile = $data['phone_mobile'];
        $contact->fax = $data['fax'];

        $contact->external_client_id = \Illuminate\Support\Arr::get($data, 'client.id');

        return $contact;
    }
}
