<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LoginController as ApiLoginControler;
use App\Http\Controllers\AirlineController;
use App\Http\Controllers\AirportController;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\RemarkController;

Route::post('login', [ApiLoginControler::class, 'login'])->name('login');

Route::group(['middleware' => ['auth:api']], function () {

    Route::post('logout', [ApiLoginControler::class, 'logout'])->name('logout');

    Route::apiResource('airports', AirportController::class);

    Route::apiResource('airlines', AirlineController::class);

    Route::apiResource('flights', FlightController::class);

    Route::apiResource('remarks', RemarkController::class);

});
