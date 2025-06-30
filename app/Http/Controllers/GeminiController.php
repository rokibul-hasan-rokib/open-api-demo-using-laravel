<?php

namespace App\Http\Controllers;

use App\Services\DeepSeekService;
use Illuminate\Http\Request;

class GeminiController extends Controller
{
    public function chat(Request $request)
    {
        $userMessage = $request->input('message');

        $apiKey = env('GEMINI_API_KEY');

        $response = Http::post("https://generativelanguage.googleapis.com/v1beta/models/gemini-pro:generateContent?key={$apiKey}", [
            'contents' => [
                [
                    'parts' => [
                        ['text' => $userMessage]
                    ]
                ]
            ]
        ]);

        $data = $response->json();

        if (isset($data['candidates'][0]['content']['parts'][0]['text'])) {
            return response()->json([
                'reply' => $data['candidates'][0]['content']['parts'][0]['text']
            ]);
        }

        return response()->json([
            'reply' => '❌ Gemini API Error: ' . ($data['error']['message'] ?? 'Unknown error.')
        ], 500);
    }

    public function askAi(Request $request)
    {
        $service = new DeepSeekService();
        $response = $service->ask($request->input('question'));

        return response()->json($response);
    }
}
