<?php

use App\Http\Livewire\Dashboard\Reservation as ReservationDashboard;

use App\Http\Livewire\Calendar\Index as CalendarIndex;

Route::group(['prefix' => '/reservations'], function () {
    Route::get('', [Reservations::class,'index'])
        ->name('reservation.index');
    Route::get('/calendar', CalendarIndex::class)
        ->name('reservation.calendar');
    Route::get('/configuration', [Reservations::class,'configuration'])
        ->name('reservation.configuration');
//    Route::get('', [Reservations::class,'index'])
//        ->name('reservation.create-from-user');
    Route::get('/create', [Reservations::class,'index'])
        ->name('reservation.form-from-user');

    Route::get('/associate-user', [Reservations::class,'associateUser'])
        ->name('reservation.associate-user');

    Route::get('/dashboard',ReservationDashboard::class)->name('reservations.dashboard');

});



