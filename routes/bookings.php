<?php


use App\Http\Controllers\Bookings as Bookings;

Route::group(['prefix' => '/schedulers'], function () {
    Route::get('/', [Bookings::class, 'index'])
        ->name('schedulers.home')
        ->can('scheduler:index');
});
