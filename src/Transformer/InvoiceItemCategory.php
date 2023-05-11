<?php

namespace Byte5\LaravelHarvest\Transformer;

use Byte5\LaravelHarvest\Contracts\Transformer;
use Byte5\LaravelHarvest\Models\InvoiceItemCategory as InvoiceItemCategoryModel;
use Illuminate\Database\Eloquent\Model;

class InvoiceItemCategory implements Transformer
{
    public function transformModelAttributes(array $data): Model
    {
        $invoiceItemCat = new InvoiceItemCategoryModel;

        if (config('harvest.uses_database')) {
            $invoiceItemCat = $invoiceItemCat->firstOrNew(['external_id' => $data['id']]);
        }

        $invoiceItemCat->external_id = $data['id'];
        $invoiceItemCat->name = $data['name'];
        $invoiceItemCat->use_as_expense = $data['use_as_expense'];
        $invoiceItemCat->use_as_service = $data['use_as_service'];

        return $invoiceItemCat;
    }
}
