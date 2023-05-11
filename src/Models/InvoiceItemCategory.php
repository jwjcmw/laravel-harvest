<?php

namespace Byte5\LaravelHarvest\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceItemCategory extends Model
{
    protected $casts = [
        'use_as_service' => 'boolean',
        'use_as_expense' => 'boolean',
    ];
    protected $dates = ['created_at', 'updated_at'];
    protected $fillable = [
        'external_id', 'name', 'use_as_expense', 'use_as_service',
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable(
            config('harvest.table_prefix').config('harvest.table_names.invoice_item_categories')
        );
    }
}
