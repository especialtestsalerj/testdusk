<?php

use App\Http\Controllers\Event;

Route::group(['prefix' => '/events'], function () {
    Route::get('/create/{routine_id}', [Event::class, 'create'])->name('events.create');

    Route::post('/', [Event::class, 'store'])->name('events.store');

    Route::get('/{id}', [Event::class, 'show'])->name('events.show');

    Route::post('/{id}', [Event::class, 'update'])->name('events.update');
});
