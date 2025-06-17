<?php

use App\Http\Controllers\{AuthController, PostController, AvaliacaoController};
use App\Http\Middleware\AddUserIdToRequest;
use Illuminate\Support\Facades\Route;

Route::get('/health', function () {
    return response()->json(['status' => 'OK'], 200);
});

Route::post('/analise', [AvaliacaoController::class, 'analise']);

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum', AddUserIdToRequest::class])->group(function () {
    Route::apiResource('posts', PostController::class);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);
});
