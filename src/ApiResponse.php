<?php

namespace Byte5\LaravelHarvest;

use Byte5\LaravelHarvest\Contracts\Transformer as TransformerContract;
use Byte5\LaravelHarvest\Traits\CanConvertDateTimes;
use Byte5\LaravelHarvest\Transformer\OneOnOneTransformer;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Psr\Http\Message\ResponseInterface;
use RuntimeException;
use function json_decode;

class ApiResponse
{
    use CanConvertDateTimes;

    protected mixed $jsonResult;

    /**
     * ApiResult constructor.
     */
    public function __construct(
        protected ResponseInterface $data,
        protected string $model
    ) {
        $this->jsonResult = json_decode($data->getBody(), true);
    }

    /**
     * Transform results to json.
     */
    public function toJson(): mixed
    {
        return $this->jsonResult;
    }

    /**
     * Transforms results into collection.
     */
    public function toCollection(): Collection
    {
        if (! array_key_exists('total_entries', $this->jsonResult)) {
            return $this->transformToModel([$this->jsonResult]);
        }

        return $this->transformToModel($this->jsonResult[$this->getResultsKey()]);
    }

    /**
     * Transform results to collection.
     *
     * @return mixed
     */
    public function toPaginatedCollection()
    {
        $this->jsonResult[$this->getResultsKey()] = $this->toCollection();

        return $this->jsonResult;
    }

    /**
     * Go to next page of json result.
     */
    public function next(): ApiResponse
    {
        if (! $this->hasNextPage()) {
            throw new RuntimeException('The result does not have a next page!');
        }

        return new self(
            (new ApiGateway())->execute(Arr::get($this->jsonResult, 'links.next')),
            $this->model
        );
    }

    /**
     * Go to previous page of json result.
     */
    public function previous(): ApiResponse
    {
        if (! $this->hasPreviousPage()) {
            throw new RuntimeException('The result does not have a previous page!');
        }

        return new self(
            (new ApiGateway())->execute(Arr::get($this->jsonResult, 'links.previous')),
            $this->model
        );
    }

    public function hasNextPage(): bool
    {
        return Arr::get($this->jsonResult, 'links.next') !== null;
    }

    public function hasPreviousPage(): bool
    {
        return Arr::get($this->jsonResult, 'links.previous') !== null;
    }

    private function transformToModel(array $data): Collection
    {
        $model = $this->model;
        $transformer = $this->getTransformer($model);

        return $this->convertDateTimes($data)
            ->map(static fn(array $data) => $transformer->transformModelAttributes($data, $model));
    }

    private function getTransformer(string $model): TransformerContract
    {
        static $transformers;
        if (isset($transformers[$model])) {
            return $transformers[$model];
        }

        $transformerName = '\\Byte5\\LaravelHarvest\\Transformer\\' . class_basename($model);
        return $transformers[$model] = new (class_exists($transformerName) ? $transformerName : OneOnOneTransformer::class);
    }

    private function getResultsKey(): string
    {
        return Str::snake(
            Str::plural(
                class_basename($this->model)
            )
        );
    }
}
