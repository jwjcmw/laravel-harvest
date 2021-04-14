<?php

namespace Byte5\LaravelHarvest\Transformer;

use Byte5\LaravelHarvest\Contracts\Transformer;
use Byte5\LaravelHarvest\Models\InvoicePayment as InvoicePaymentModel;

class InvoicePayment implements Transformer
{
    /**
     * @param $data
     * @return mixed
     */
    public function transformModelAttributes($data)
    {
        $invoicePayment = new InvoicePaymentModel;

        if (config('harvest.uses_database')) {
            $invoicePayment = $invoicePayment->firstOrNew(['external_id' => $data['id']]);
        }

        $invoicePayment->external_id = $data['id'];
        $invoicePayment->payment_gateway_id = \Illuminate\Support\Arr::get($data, 'payment_gateway_id', null);
        $invoicePayment->amount = $data['amount'];
        $invoicePayment->recorded_by = $data['recorded_by'];
        $invoicePayment->recorded_by_email = \Illuminate\Support\Arr::get($data, 'recorded_by_email', null);
        $invoicePayment->notes = $data['notes'];
        $invoicePayment->transaction_id = $data['transaction_id'];
        $invoicePayment->paid_at = $data['paid_at'];

        return $invoicePayment;
    }
}
