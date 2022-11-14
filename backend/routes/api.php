<?php

use App\Http\Controllers\Component\ComponentController;
use App\Http\Controllers\ComponentType\ComponentTypeController;
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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::apiResource('components', ComponentController::class);

Route::get('/component-types/{type}/attributes', [ComponentTypeController::class, 'getRequiredAttributes']);
Route::get('/component-types/', [ComponentTypeController::class, 'index']);

