<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\UserController;
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

Route::get('/', [HomeController::class, 'index']);
Route::prefix('/users')->group(function() {
    Route::prefix('/create')->group(function() {
        Route::get('/', [UserCreateController::class, 'view']);
        Route::post('/', [UserCreateController::class, 'user_create']);
    });
    Route::prefix('/login')->group(function() {
        Route::get('/', [UserLoginController::class, 'view']);
        Route::post('/', [UserLoginController::class, 'user_login']);
    });
    Route::get('/logout', [UserController::class, 'user_logout']);
    Route::prefix('/mails')->group(function() {
        Route::get('/mail', [MailController::class, 'find_one']);
        Route::get('/', [MailController::class, 'find_all']);
    });
});
