<?php

use App\Http\Controllers\AirportController;
use App\Http\Controllers\Api\LoginController as ApiLoginControler;
use App\Http\Controllers\Api\RegisterController as ApiRegisterControler;
use App\Http\Controllers\Api\AuthenticationController;
use Illuminate\Support\Facades\Route;

Route::group(['as' => 'api.v1.'], function () {

    Route::post('login', [ApiLoginControler::class, 'login'])->name('login');

    Route::post('register', [ApiRegisterControler::class, 'register'])->name('register');


    Route::group(['middleware' => ['auth:api']], function () {

        Route::apiResource('airports', AirportController::class);

        Route::get('user', [AuthenticationController::class, 'user'])->name('user');

        Route::post('logout', [ApiLoginControler::class, 'logout'])->name('logout');

    });

});
