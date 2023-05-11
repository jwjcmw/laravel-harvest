<?php

namespace Byte5\LaravelHarvest\Models;

use Illuminate\Database\Eloquent\Model;

class InvoicePayment extends Model
{
    protected $dates = ['created_at', 'updated_at', 'paid_at'];
    protected $fillable = [
        'external_id', 'payment_gateway_id', 'amount', 'recorded_by',
        'recorded_by_email', 'notes', 'transaction_id', 'paid_at',
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable(
            config('harvest.table_prefix').config('harvest.table_names.invoice_payments')
        );
    }
}
