<?php

namespace Byte5\LaravelHarvest\Test\Fakes;

use Byte5\LaravelHarvest\ApiManager;
use Byte5\LaravelHarvest\ApiResponse;
use GuzzleHttp\Psr7\Response;

class FakeApiManager extends ApiManager
{
    /**
     * @var callable
     */
    protected $beforeCraftingResponseCallback;

    /**
     * @return mixed
     */
    public function getRequestUrl()
    {
        return $this->endpoint->getUrl();
    }

    /**
     * @return mixed
     */
    public function getEndpoint()
    {
        return $this->endpoint;
    }

    public function beforeCraftingResponse(callable $callback): void
    {
        $this->beforeCraftingResponseCallback = $callback;
    }

    /**
     * @param $name
     * @param $arguments
     * @return ApiResponse
     * @override
     */
    public function __call($name, $arguments)
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

        $this->beforeCraftingResponseCallback !== null && ($this->beforeCraftingResponseCallback)();
        $this->beforeCraftingResponseCallback = null;

        return tap($this->craftResponse($url), $this->clearEndpoint(...));
    }

    protected function craftResponse($url): ApiResponse
    {
        return new ApiResponse(
            new Response(),
            $this->endpoint->getModel()
        );
    }
}
