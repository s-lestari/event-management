<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\AttendeeController;
use App\Http\Controllers\Api\AuthController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::post('/register', [AuthController::class, 'register']);

Route::apiResource('events', EventController::class)
    ->only(['index', 'show']);

// Protected routes
Route::apiResource('events', EventController::class)
    ->only(['store', 'update', 'destroy'])
    ->middleware(['auth:sanctum', 'throttle:api']);

// Protected routes
Route::apiResource('events.attendees', AttendeeController::class)
    ->scoped()
    ->only(['store', 'destroy'])
    ->middleware(['auth:sanctum', 'throttle:api']);

// Public routes
Route::apiResource('events.attendees', AttendeeController::class)
    ->scoped()
    ->only(['index', 'show']);
