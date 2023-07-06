<?php

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\EventController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::post('/login', [LoginController::class, "login"])->name('login');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/logout', [LoginController::class, "logout"]);
    Route::get('/list', [EventController::class, 'index']);
    Route::get('/{event}', [EventController::class, 'show']);
    Route::put('/{event}', [EventController::class, 'update']);
    Route::patch('/{event}', [EventController::class, 'edit']);
});
