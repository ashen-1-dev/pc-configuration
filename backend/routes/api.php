<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Build\BuildController;
use App\Http\Controllers\Component\ComponentController;
use App\Http\Controllers\ComponentType\ComponentTypeController;
use App\Http\Controllers\User\UserController;
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

// COMPONENTS

Route::apiResource('components', ComponentController::class);

// COMPONENT TYPES

Route::get('/component-types/{type}/attributes', [ComponentTypeController::class, 'getRequiredAttributes']);
Route::get('/component-types/', [ComponentTypeController::class, 'index']);

// AUTH

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/logout', [AuthController::class, 'logout']);

// USER

Route::middleware(['auth:sanctum'])->group(function () {
    Route::put('/user', [UserController::class, 'update']);
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/users/{id}', [UserController::class, 'show'])->where('id', '[0-9]+');
    Route::get('/users/me', [UserController::class, 'getAuthUser']);
});

// BUILD

Route::apiResource('builds', BuildController::class)->middleware(['auth:sanctum']);
Route::get('/builds/{id}/add', [BuildController::class, 'addBuildToUser'])->middleware(['auth:sanctum']);
Route::post('/builds/check', [BuildController::class, 'checkBuildIsReady'])->middleware(['auth:sanctum']);
