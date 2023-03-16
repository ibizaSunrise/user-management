<?php


use App\Http\Controllers\API\V1\UserController;
use App\Http\Controllers\SanctumController;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'user','middleware' => 'auth:sanctum'], function(){
    Route::get('/', [UserController::class, 'index']);
    Route::post('/', [UserController::class, 'store']);
    Route::put('/{user}', [UserController::class, 'update']);
    Route::delete('/{user}', [UserController::class, 'destroy']);
    Route::post('/image', [UserController::class, 'handleImage']);
    Route::get('/auth', [UserController::class, 'getAuthUser']);
});

Route::post('/getToken', [SanctumController::class, 'create']);

