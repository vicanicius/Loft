<?php

use App\Http\Controllers\BattleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/user', [UserController::class, 'create'])->middleware('userValidation');
Route::get('/user', [UserController::class, 'allUsers']);
Route::get('/user/{id}', [UserController::class, 'getUser']);
Route::post('/battle/{userId1}/{userId2}', [BattleController::class, 'battle'])->middleware('battleValidation');