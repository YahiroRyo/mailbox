<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Mail\MailSendController;
use App\Http\Controllers\Mail\MailReceiveController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\UserCreateController;
use App\Http\Controllers\User\UserLoginController;
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
    Route::prefix('/receive')->group(function() {
        Route::prefix('/mails')->group(function() {
            Route::get('/mail', [MailReceiveController::class, 'find_one']);
            Route::get('/', [MailReceiveController::class, 'find_all']);
            Route::delete('/{mail_id}', [MailReceiveController::class, 'mail_delete']);
        });
    });
    Route::prefix('/send')->group(function() {
        Route::get('/', [MailSendController::class, 'view']);
        Route::post('/', [MailSendController::class, 'mail_send']);
        Route::prefix('/mails')->group(function() {
            Route::get('/mail', [MailSendController::class, 'find_one']);
            Route::get('/', [MailSendController::class, 'find_all']);
        });
    });
});
