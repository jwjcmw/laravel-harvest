<?php

namespace Byte5\LaravelHarvest;

use Byte5\LaravelHarvest\Endpoints\BaseEndpoint;
use Byte5\LaravelHarvest\Traits\CanResolveEndpoints;

class ApiManager
{
    use CanResolveEndpoints;

    protected ?BaseEndpoint $endpoint = null;

    public function __construct(
        protected ApiGateway $gateway
    ) {}

    protected function setEndpoint(string $name): void
    {
        $this->endpoint = $this->resolveEndpoint($name);
    }

    /**
     * @param $name
     * @return $this
     */
    public function __get($name)
    {
        $this->setEndpoint($name);

        return $this;
    }

    public function __call(string $name, array $arguments)
    {
        if ($this->isStaticCall() && ! $this->endpoint) {
            $this->setEndpoint($name);

            return $this;
        }

        if (! method_exists($this->endpoint, $name)) {
            throw new \RuntimeException("Endpoint method $name does not exist!");
        }

        $url = call_user_func_array([$this->endpoint, $name], $arguments);
        if (null === $url) {
            return $this;
        }

        return tap($this->craftResponse($url), $this->clearEndpoint(...));
    }

    protected function clearEndpoint(): void
    {
        $this->endpoint = null;
    }

    protected function craftResponse($url): ApiResponse
    {
        return new ApiResponse($this->gateway->execute($url), $this->endpoint->getModel());
    }

    /**
     * @return bool
     */
    protected function isStaticCall()
    {
        return ! $this->endpoint;
    }
}
