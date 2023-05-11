<?php

namespace Byte5\LaravelHarvest\Endpoints;

class EstimateMessage extends BaseEndpoint
{
    protected function getPath(): string
    {
        return 'estimates/{estimate_ID}/messages';
    }

    public function getModel(): string
    {
        return \Byte5\LaravelHarvest\Models\EstimateMessage::class;
    }

    public function fromEstimate(int $id): void
    {
        $this->baseId = $id;
    }
}
