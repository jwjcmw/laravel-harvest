<?php

namespace Byte5\LaravelHarvest\Models;

use Illuminate\Database\Eloquent\Model;

class EstimateItemCategory extends Model
{
    protected $dates = ['created_at', 'updated_at'];
    protected $fillable = ['external_id', 'name'];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable(
            config('harvest.table_prefix').config('harvest.table_names.estimate_item_categories')
        );
    }
}
