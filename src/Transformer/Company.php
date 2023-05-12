<?php

namespace Byte5\LaravelHarvest\Transformer;

use Illuminate\Database\Eloquent\Model;

class Company extends OneOnOneTransformer
{
    public function transformModelAttributes(array $data, string $modelName = null, string $key = 'full_domain'): Model
    {
        return parent::transformModelAttributes($data, $modelName, $key);
    }
}
