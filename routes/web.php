<?php

use App\Http\Controllers\OpenAIController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/chat', function () {
    return view('chat');
});

Route::post('/ask-ai', [OpenAIController::class, 'chat'])->middleware('web');