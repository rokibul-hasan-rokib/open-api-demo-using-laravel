<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

class DeepSeekService
{
    protected $client;
    protected $apiKey;
    protected $baseUrl = 'https://api.deepseek.com/v1'; // Check actual API URL

    public function __construct()
    {
        $this->client = new Client();
        $this->apiKey = env('DEEPSEEK_API_KEY');
    }

    public function ask($prompt)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer '.$this->apiKey,
        ])->post($this->baseUrl.'/chat', [
            'prompt' => $prompt,
            'max_tokens' => 150,
        ]);

        return $response->json();
    }
}
