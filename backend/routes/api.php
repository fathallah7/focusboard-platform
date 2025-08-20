<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactMessageController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\QuoteReactionController;
use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// Authenticated routes
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);


Route::middleware(('auth:sanctum'))->group(function () {

    // Profile
    Route::get('/profile', [ProfileController::class, 'index']);
    Route::put('/profile', [ProfileController::class, 'update']);
    Route::delete('/profile', [ProfileController::class, 'destroy']);

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index']);

    // Logout User
    Route::post('/logout', [AuthController::class, 'logout']);

    // Tasks
    Route::apiResource('/tasks', TaskController::class);

    // Quotes
    Route::apiResource('/quotes', QuoteController::class);

    // Quotes Reactions
    Route::post('/quotes/{quote}/react', [QuoteReactionController::class, 'store']);
    Route::delete('/quotes/{quote}/react', [QuoteReactionController::class, 'destroy']);

    // Contact Message
    Route::post('/contact', [ContactMessageController::class, 'store']);
});
