<?php

namespace Byte5\LaravelHarvest\Transformer;

use Byte5\LaravelHarvest\Contracts\Transformer;
use Byte5\LaravelHarvest\Models\EstimateItemCategory as EstimateItemCategoryModel;
use Illuminate\Database\Eloquent\Model;

class EstimateItemCategory implements Transformer
{
    public function transformModelAttributes(array $data): Model
    {
        $estimateItemCat = new EstimateItemCategoryModel;

        if (config('harvest.uses_database')) {
            $estimateItemCat = $estimateItemCat->firstOrNew(['external_id' => $data['id']]);
        }

        $estimateItemCat->external_id = $data['id'];
        $estimateItemCat->name = $data['name'];

        return $estimateItemCat;
    }
}
