<?php

namespace Byte5\LaravelHarvest\Contracts;

use Illuminate\Database\Eloquent\Model;

interface Transformer
{
    public function transformModelAttributes(array $data): Model;
}
