<?php

namespace Byte5\LaravelHarvest\Traits;

use Byte5\LaravelHarvest\Endpoints\BaseEndpoint;
use Illuminate\Support\Str;

trait CanResolveEndpoints
{
    /**
     * Resolve Endpoint name to endpoint class instance.
     */
    protected function resolveEndpoint(string $name): BaseEndpoint
    {
        $endpointClass = '\\Byte5\\LaravelHarvest\\Endpoints\\' . Str::singular(Str::ucfirst($name));

        if (! is_a($endpointClass, BaseEndpoint::class, true)) {
            throw new \RuntimeException("Endpoint {$endpointClass} does not exist!");
        }

        return new $endpointClass;
    }
}
