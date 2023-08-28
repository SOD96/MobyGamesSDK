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

    /**
     * @param $gameId
     * @return mixed
     * Returns a game by its ID
     */
    public function getGame($gameId)
    {
        $response = $this->httpClient->get("games/{$gameId}" . $this->buildUrlString(), [
            'headers' => [
                'Authorization' => "Bearer {$this->apiKey}",
            ],
        ]);

        return json_decode($response->getBody(), true);
    }

    /**
     * @param $gameId
     * @return mixed
     * Returns a an array of potential games to a search query
     */
    public function getGames($title)
    {
        $response = $this->httpClient->get("games" . $this->buildUrlString([
                'title' => $title,
                'format' => 'brief' // Limited set of data so we can return the whole thing later
            ]), [
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
        ], '', '&', PHP_QUERY_RFC3986);

    }
}
