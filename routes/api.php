<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LoginController as ApiLoginControler;
use App\Http\Controllers\AirlineController;
use App\Http\Controllers\AirportController;

Route::group(['as' => 'api.v1.'], function () {

    Route::post('login', [ApiLoginControler::class, 'login'])->name('login');

    Route::group(['middleware' => ['auth:api']], function () {

        Route::apiResource('airports', AirportController::class);

        Route::apiResource('airlines', AirlineController::class);

        Route::post('logout', [ApiLoginControler::class, 'logout'])->name('logout');

    });

});
