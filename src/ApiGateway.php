<?php

namespace Byte5\LaravelHarvest;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

class ApiGateway
{
    /**
     * @throws GuzzleException
     */
    public function execute(array|string $path): ResponseInterface
    {
        $client = new Client();
        $headers = [
            'Authorization' => 'Bearer ' . config('harvest.api_key'),
            'Harvest-Account-Id' => config('harvest.account_id'),
        ];

        if (is_string($path) || !isset($path['method']) || $path['method'] === 'GET') {
            return $client->request('GET', $path['url'] ?? $path, [
                'headers' => $headers
            ]);
        }

        $path = (array)$path;

        if (($path['method'] ?? 'GET') === 'DELETE') {
            return $client->request('DELETE', $path['url'] ?? $path, [
                'headers' => $headers
            ]);
        }

        if (($path['method'] ?? 'GET') === 'PATCH') {
            return $client->request('PATCH', $path['url'], [
                'headers' => $headers,
                'form_params' => $path['body']
            ]);
        }

        if (($path['method'] ?? 'GET') === 'POST') {
            return $client->request('POST', $path['url'], [
                'headers' => $headers,
                'form_params' => $path['body']
            ]);
        }

        throw new \Exception('HTTP verb ' . $path['method'] . ' is not supported.');
    }
}
