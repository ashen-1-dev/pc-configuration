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

Route::prefix('components')->group(function () {
    Route::get('/', [ComponentController::class, 'index']);
    Route::post('/', [ComponentController::class, 'store'])->middleware(['role:admin', 'auth:sanctum']);
    Route::post('/{id}', [ComponentController::class, 'update'])->middleware(['role:admin', 'auth:sanctum']);;
    Route::delete('/{id}', [ComponentController::class, 'destroy'])->middleware(['role:admin', 'auth:sanctum']);;
});

// COMPONENT TYPES

Route::get('/component-types/{type}/attributes', [ComponentTypeController::class, 'getRequiredAttributes']);
Route::get('/component-types/', [ComponentTypeController::class, 'index']);

// AUTH

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/logout', [AuthController::class, 'logout']);

// USER

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/user', [UserController::class, 'update']);
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/users/{id}', [UserController::class, 'show'])->where('id', '[0-9]+');
    Route::get('/users/me', [UserController::class, 'getAuthUser']);
});


// BUILD

Route::prefix('builds')->group(function () {
    Route::get('/', [BuildController::class, 'index']);
    Route::post('/', [BuildController::class, 'store'])->middleware(['auth:sanctum']);
    Route::put('/{id}', [BuildController::class, 'update'])->middleware(['auth:sanctum']);
    Route::delete('/{id}', [BuildController::class, 'destroy'])->middleware(['auth:sanctum']);
    Route::get('/{id}/add', [BuildController::class, 'addBuildToUser'])->middleware(['auth:sanctum']);
    Route::post('/check', [BuildController::class, 'checkBuildIsReady'])->middleware(['auth:sanctum']);
    Route::get('/{id}/create-report', [BuildController::class, 'createExcelReport']);
//        ->middleware(['auth:sanctum']);
});
Route::get('/users/builds/my', [BuildController::class, 'getAuthUserBuilds'])->middleware(['auth:sanctum']);


Route::get('tmp-files', function (\Illuminate\Http\Request $request) {
    $filePath = $request->input('filePath');
    if (!\request()->hasValidSignature() && $filePath) {
        abort(401);
    }
    try {
        return Response::download(storage_path('/app/' . $filePath))
            ->deleteFileAfterSend($request->input('deleteAfterDownload') ?? false);
    } catch (Exception) {
        return response()->json(['status' => false, 'message' => 'ошибка при загрузки файла'], 500);
    }

})->name('local.temp');
