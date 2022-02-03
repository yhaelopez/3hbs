<?php

use App\Http\Controllers\Api\LoginController as ApiLoginControler;
use Illuminate\Support\Facades\Route;

Route::group(['as' => 'api.'], function () {

    Route::post('login', [ApiLoginControler::class, 'login'])->name('login');

    Route::post('register', [RegisterController::class, 'register'])->name('register');

    Route::group(['middleware' => ['auth:api']], function () {

        Route::get('user', [AuthenticationController::class, 'user'])->name('user');

        Route::post('logout', [LoginController::class, 'logout'])->name('logout');

    });
});
