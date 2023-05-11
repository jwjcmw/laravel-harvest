<?php

namespace Byte5\LaravelHarvest\Transformer;

use Byte5\LaravelHarvest\Contracts\Transformer;
use Byte5\LaravelHarvest\Models\Reports\Uninvoiced\Result as ReportsUninvoicedModel;
use Illuminate\Database\Eloquent\Model;

class Result implements Transformer
{
    public function transformModelAttributes(array $data): Model
    {
        return app()->make(ReportsUninvoicedModel::class)
                ->fill($data);
    }
}