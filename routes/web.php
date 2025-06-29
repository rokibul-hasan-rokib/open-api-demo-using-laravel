<?php

use App\Http\Controllers\GeminiController;
use App\Http\Controllers\OpenAIController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// for openai

// Route::get('/chat', function () {
//     return view('chat');
// });

// Route::post('/ask-ai', [OpenAIController::class, 'chat'])->middleware('web');

// for gemini
Route::get('/chat-gemini', function () {
    return view('chat-gemini'); // View file for the form
});

Route::post('/ask-ai', [GeminiController::class, 'chat']);