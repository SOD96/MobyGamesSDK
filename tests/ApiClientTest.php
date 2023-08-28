<?php

use SOD96\MobyGames\ApiClient;
use PHPUnit\Framework\TestCase;
use Dotenv\Dotenv;


class ApiClientTest extends TestCase
{
    protected function setUp(): void
    {
        // Load the environment variables from .env.testing
        $dotenv = Dotenv::createImmutable(__DIR__ . '/../');
        $dotenv->load();
    }
    public function testGetGame()
    {
        $apiKey = $_ENV['MOBY_GAMES_API_KEY']; // Replace with your actual API key
        $apiClient = new ApiClient($apiKey);

        $gameId = 175320; // Battlefield 2042
        $gameData = $apiClient->getGame($gameId);

        $this->assertArrayHasKey('title', $gameData);
        $this->assertArrayHasKey('platforms', $gameData);

        sleep(2);
    }

    public function testGetGames()
    {
        $apiKey = $_ENV['MOBY_GAMES_API_KEY']; // Replace with your actual API key
        $apiClient = new ApiClient($apiKey);

        $gameData = $apiClient->getGames('Battlefield 2042');

        // We should get an array of games back
        $this->assertIsArray($gameData);

        // Check the games array exists
        $this->assertArrayHasKey('games', $gameData);

        // We should get at least one game back
        $this->assertGreaterThan(0, count($gameData['games']));

        // Each game should have a game_id and title
        $this->assertArrayHasKey('game_id', $gameData['games'][0]);
        $this->assertArrayHasKey('title', $gameData['games'][0]);
        sleep(2);
    }
}
