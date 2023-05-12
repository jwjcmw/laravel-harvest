<?php

namespace Byte5\LaravelHarvest\Transformer;

use Byte5\LaravelHarvest\Contracts\Transformer as TransformerContract;
use Illuminate\Contracts\Container\BindingResolutionException as BindingResolutionExceptionAlias;
use Illuminate\Database\Eloquent\Model;

class OneOnOneTransformer implements TransformerContract
{
    /**
     * @param array $data
     * @param string|null $modelName
     * @param string|null $key
     * @return Model
     * @throws BindingResolutionExceptionAlias
     */
    public function transformModelAttributes(array $data, string $modelName = null, string $key = 'external_id'): Model
    {
        /** @var Model $model */
        $model = app()->make($modelName);

        if (method_exists($model, 'fillWithExternalReferenceData')) {
            return $model->fillWithExternalReferenceData($data, $key);
        }

        return $model->fill($data);
    }
}