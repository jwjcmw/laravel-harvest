<?php

namespace Byte5\LaravelHarvest\Endpoints;

class InvoiceItemCategory extends BaseEndpoint
{
    protected function getPath(): string
    {
        return 'invoice_item_categories';
    }

    public function getModel(): string
    {
        return \Byte5\LaravelHarvest\Models\InvoiceItemCategory::class;
    }
}
