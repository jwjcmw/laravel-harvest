<?php

namespace Byte5\LaravelHarvest\Endpoints;

class InvoicePayment extends BaseEndpoint
{
    protected function getPath(): string
    {
        return 'invoices/{INVOICE_ID}/payments';
    }

    public function getModel(): string
    {
        return \Byte5\LaravelHarvest\Models\InvoicePayment::class;
    }

    public function fromInvoice(int $id): void
    {
        $this->baseId = $id;
    }
}
