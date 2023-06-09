<?php


use App\Http\Controllers\API\V1\UserController;
use App\Http\Controllers\SanctumController;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')
    ->group(function () {
        Route::prefix('user')->group(function () {
            Route::get('/', [UserController::class, 'index']);
            Route::post('/', [UserController::class, 'store']);
            Route::put('/{user}', [UserController::class, 'update']);
            Route::delete('/{user}', [UserController::class, 'destroy']);
            Route::post('/image', [UserController::class, 'handleImage']);
            Route::get('/auth', [UserController::class, 'getAuthUser']);
        });;

        Route::prefix('v2')
            ->name('v2.')
            ->group(function () {
                Route::prefix('user')
                    ->name('user.')
                    ->group(function () {
                        Route::get('/', [\App\Http\Controllers\API\V2\UserController::class, 'index'])->name('index');
                        Route::post('/', [\App\Http\Controllers\API\V2\UserController::class, 'store'])->name('store');
                        Route::put('/{id}', [\App\Http\Controllers\API\V2\UserController::class, 'update'])->name('update');
                        Route::delete('/{id}', [\App\Http\Controllers\API\V2\UserController::class, 'destroy'])->name('delete');
                    });
            });
    });

Route::post('/getToken', [SanctumController::class, 'create']);

