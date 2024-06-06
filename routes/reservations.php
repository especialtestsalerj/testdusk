<?php

use App\Http\Controllers\Reservations as Reservations;

Route::group(['prefix' => '/reservations'], function () {
    Route::get('', [Reservations::class,'index'])
        ->name('reservation.index');
    Route::get('/calendar', [Reservations::class,'calendar'])
        ->name('reservation.calendar');
//    Route::get('', [Reservations::class,'index'])
//        ->name('reservation.create-from-user');
    Route::get('/create', [Reservations::class,'index'])
        ->name('reservation.form-from-user');

});



