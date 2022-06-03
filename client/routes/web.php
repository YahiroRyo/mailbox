<?php

use App\Http\Controllers\UserCreateController;
use App\Http\Controllers\UserLoginController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('/users')->group(function() {
    Route::prefix('/create')->group(function() {
        Route::get('/', [UserCreateController::class, 'view']);
        Route::post('/', [UserCreateController::class, 'create']);
    });
    Route::prefix('/login')->group(function() {
        Route::get('/', [UserLoginController::class, 'view']);
        Route::post('/', [UserLoginController::class, 'login']);
    });
});
