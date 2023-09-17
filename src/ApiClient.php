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
     * @return mixed
     * This endpoint provides a list of genres which may be used for filtering games via the API.
     */
    public function getGenres()
    {
        $response = $this->httpClient->get("genres/", [
            'headers' => [
                'Authorization' => "Bearer {$this->apiKey}",
            ],
        ]);

        return json_decode($response->getBody(), true);
    }

    /**
     * @param int $limit
     * @param int $offset
     * @return mixed
     * This endpoint provides a list of groups which may be used for filtering games via the API.
     */
    public function getGroups(int $limit = 100, int $offset = 0)
    {
        $response = $this->httpClient->get("groups" . $this->buildUrlString([
                'limit' => $limit,
                'offset' => $offset
            ]));

        return json_decode($response->getBody(), true);
    }


    /**
     * @return mixed
     * This endpoint provides a list of platforms which may be used for filtering games via the API.
     */
    public function getPlatforms()
    {
        $response = $this->httpClient->get("platforms");

        return json_decode($response->getBody(), true);
    }


    /**
     * Games Endpoints
     */

    /**
     * @param int $gameId
     * @return mixed
     * Returns a game by its ID
     */
    public function getGame(int $gameId)
    {
        $response = $this->httpClient->get("games/{$gameId}" . $this->buildUrlString());

        return json_decode($response->getBody(), true);
    }

    /**
     * @param $gameId
     * @return mixed
     * Returns a an array of potential games to a search query
     */
    public function getGames($title, $format = 'brief')
    {
        $response = $this->httpClient->get("games" . $this->buildUrlString([
                'title' => $title,
                'format' => $format // Limited set of data so we can return the whole thing later
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
