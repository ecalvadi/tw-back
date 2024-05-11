<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PositionController;
use App\Models\Position;

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api')->name('logout');
    Route::post('/refresh', [AuthController::class, 'refresh'])->middleware('auth:api')->name('refresh');
    Route::post('/me', [AuthController::class, 'me'])->middleware('auth:api')->name('me');
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'positions'
], function ($router) {
    Route::post('', [PositionController::class, 'create'])->middleware('auth:api')->name('create');
    Route::get('/byUser', [PositionController::class, 'getByUser'])->middleware('auth:api')->name('getByUser');
    Route::put('/{positionId}', [PositionController::class, 'update'])->middleware('auth:api')->name('update');
    Route::delete('/{positionId}', [PositionController::class, 'delete'])->middleware('auth:api')->name('delete');
});
