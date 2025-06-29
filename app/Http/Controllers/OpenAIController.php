<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class OpenAIController extends Controller
{

    public function chat(Request $request)
    {
        $message = $request->input('message');

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
        ])->post('https://api.openai.com/v1/chat/completions', [
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                ['role' => 'user', 'content' => $message],
            ],
        ]);

        if ($response->successful()) {
            $data = $response->json();
            return response()->json([
                'reply' => $data['choices'][0]['message']['content'] ?? 'No response content.'
            ]);
        } else {
            return response()->json([
                'reply' => 'OpenAI request failed: ' . $response->body()
            ], 500);
        }
    }


}

