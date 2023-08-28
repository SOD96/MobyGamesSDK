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
        // Add more assertions as needed to validate the response structure
    }
}
