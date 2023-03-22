<?php

use Illuminate\Http\Request;
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

Route::apiResource('users', \App\Http\Controllers\Api\UserController::class);
Route::apiResource('zones', \App\Http\Controllers\Api\ZoneController::class);

Route::post('/messages', [\App\Http\Controllers\Api\MessageController::class, 'store']);


Route::group(['middleware' => ['auth:api']], function() {
    Route::get('/messages', [\App\Http\Controllers\Api\MessageController::class, 'index']);

    Route::get('/me', [\App\Http\Controllers\Api\UserController::class, 'me']);
    Route::get('/end_session', [\App\Http\Controllers\Api\UserController::class, 'end']);
});
