<?php

namespace SOD96\MobyGames;

use GuzzleHttp\Client;

class ApiClient
{
    private $httpClient;
    private $apiKey;

    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
        $this->httpClient = new Client([
            'base_uri' => 'https://api.mobygames.com/v1/',
            'timeout' => 10,
        ]);
    }

    public function getGame($gameId)
    {
        $response = $this->httpClient->get("games/{$gameId}" . $this->buildUrlString(), [
            'headers' => [
                'Authorization' => "Bearer {$this->apiKey}",
            ],
        ]);

        return json_decode($response->getBody(), true);
    }

    private function buildUrlString($customParams = []): string
    {
        return '?' . http_build_query($customParams + [
            'api_key' => $this->apiKey,
        ]);

    }
}
