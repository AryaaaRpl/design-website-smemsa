<?php

use App\Http\Controllers\ChatController;
use Illuminate\Support\Facades\Route;

// Chatbot Asisten SMEMSA (tanpa sesi & CSRF; dibatasi 10 pesan/menit per IP).
Route::post('/chat', [ChatController::class, 'reply'])->middleware('throttle:chat')->name('chat.reply');
Route::get('/chat/faq', [ChatController::class, 'faq'])->middleware('throttle:60,1')->name('chat.faq');
