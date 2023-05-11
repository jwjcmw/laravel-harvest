<?php

namespace Byte5\LaravelHarvest\Endpoints;

class InvoiceMessage extends BaseEndpoint
{
    protected function getPath(): string
    {
        return 'invoices/{INVOICE_ID}/messages';
    }

    public function getModel(): string
    {
        return \Byte5\LaravelHarvest\Models\InvoiceMessage::class;
    }

    public function fromInvoice(int $id): void
    {
        $this->baseId = $id;
    }
}
