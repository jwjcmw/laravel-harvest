<?php

namespace Byte5\LaravelHarvest\Endpoints;

abstract class BaseEndpoint
{
    protected string $apiV2Url = 'https://api.harvestapp.com/v2/';
    protected int $baseId;
    protected array $params = [];

    /**
     * @var
     */
    protected string $url;

    abstract protected function getPath(): string;

    abstract public function getModel(): string;

    public function get(): array
    {
        $this->buildUrl();
        return ['url' => $this->getUrl()];
    }

    public function create(array $data): array
    {
        $this->buildUrl();
        return ['url' => $this->getUrl(), 'method' => 'POST', 'body' => $data];
    }

    public function update(array $data, string $id): array
    {
        $this->buildUrl('/' . $id);
        return ['url' => $this->getUrl(), 'method' => 'PATCH', 'body' => $data];
    }

    public function find(string $id): string
    {
        $this->buildUrl('/' . $id);
        return $this->getUrl();
    }

    protected function buildUrl(string $subPath = ''): void
    {
        $path = $this->replaceVarsInPath();

        $fullPath = $this->apiV2Url . $path . $subPath;
        $params   = $this->getUrlParams();

        $this->url = $fullPath . $params;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getUrlParams(): string
    {
        return ! empty($this->params) ? '?' . http_build_query($this->params) : '';
    }

    public function limit(int $limit): void
    {
        $this->params += ['per_page' => $limit];
    }

    public function page(int $page): void
    {
        $this->params += ['page' => $page];
    }

    public function active(bool $active = true): void
    {
        $this->params += ['is_active' => $active ? 'true' : 'false'];
    }

    private function replaceVarsInPath(): string
    {
        $tmpPath = $this->getPath();

        if (! isset($this->baseId) || ! str_contains($tmpPath, '{')) {
            return $tmpPath;
        }

        return preg_replace('/\{.*\}/', $this->baseId, $tmpPath);
    }
}
