<?php

namespace Byte5\LaravelHarvest;

use Zttp\Zttp;

class ApiGateway
{
    /**
     * @param $path
     * @return mixed
     */
    public function execute($path)
    {
        if ($path['method'] === 'POST') {
            return Zttp::withHeaders([
                'Authorization' => 'Bearer '.config('harvest.api_key'),
                'Harvest-Account-Id' => config('harvest.account_id'),
            ])->post($path['url'], $path['body']);
        } else if ($path['method'] === 'GET') {
            return Zttp::withHeaders([
                'Authorization' => 'Bearer '.config('harvest.api_key'),
                'Harvest-Account-Id' => config('harvest.account_id'),
            ])->get($path['url'] ?? $path);
        } else {
            throw new \Exception('HTTP verb ' . $path['method'] . ' is not supported.');
        }
    }
}
