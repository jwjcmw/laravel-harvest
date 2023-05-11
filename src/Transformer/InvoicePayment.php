<?php

namespace Byte5\LaravelHarvest\Transformer;

use Byte5\LaravelHarvest\Contracts\Transformer;
use Byte5\LaravelHarvest\Models\InvoicePayment as InvoicePaymentModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class InvoicePayment implements Transformer
{
    public function transformModelAttributes(array $data): Model
    {
        $invoicePayment = new InvoicePaymentModel;

        if (config('harvest.uses_database')) {
            $invoicePayment = $invoicePayment->firstOrNew(['external_id' => $data['id']]);
        }

        $invoicePayment->external_id = $data['id'];
        $invoicePayment->payment_gateway_id = Arr::get($data, 'payment_gateway_id', null);
        $invoicePayment->amount = $data['amount'];
        $invoicePayment->recorded_by = $data['recorded_by'];
        $invoicePayment->recorded_by_email = Arr::get($data, 'recorded_by_email', null);
        $invoicePayment->notes = $data['notes'];
        $invoicePayment->transaction_id = $data['transaction_id'];
        $invoicePayment->paid_at = $data['paid_at'];

        return $invoicePayment;
    }
}
