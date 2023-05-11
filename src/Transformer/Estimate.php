<?php

namespace Byte5\LaravelHarvest\Transformer;

use Byte5\LaravelHarvest\Models\Estimate as EstimateModel;
use Byte5\LaravelHarvest\Contracts\Transformer as TransformerContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Estimate implements TransformerContract
{
    public function transformModelAttributes(array $data): Model
    {
        $estimate = new EstimateModel;

        if (config('harvest.uses_database')) {
            $estimate = $estimate->firstOrNew(['external_id' => $data['id']]);
        }

        $estimate->external_id = $data['id'];
        $estimate->line_items = $data['line_items'];
        $estimate->client_key = $data['client_key'];
        $estimate->number = $data['number'];
        $estimate->purchase_order = $data['purchase_order'];
        $estimate->amount = $data['amount'];
        $estimate->tax = $data['tax'];
        $estimate->tax_amount = $data['tax_amount'];
        $estimate->tax2 = $data['tax2'];
        $estimate->tax2_amount = $data['tax2_amount'];
        $estimate->discount = $data['discount'];
        $estimate->discount_amount = $data['discount_amount'];
        $estimate->subject = $data['subject'];
        $estimate->notes = $data['notes'];
        $estimate->currency = $data['currency'];
        $estimate->issue_date = $data['issue_date'];
        $estimate->sent_at = $data['sent_at'];
        $estimate->accepted_at = $data['accepted_at'];
        $estimate->declined_at = $data['declined_at'];

        $estimate->external_client_id = Arr::get($data, 'client.id');
        $estimate->external_creator_id = Arr::get($data, 'creator.id');

        return $estimate;
    }
}
