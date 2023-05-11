<?php

namespace Byte5\LaravelHarvest\Endpoints;

class EstimateItemCategory extends BaseEndpoint
{
    protected function getPath(): string
    {
        return 'estimate_item_categories';
    }

    /**
     * @return mixed
     */
    public function getModel(): string
    {
        return \Byte5\LaravelHarvest\Models\EstimateItemCategory::class;
    }
}
