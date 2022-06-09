<?php

use App\Http\Controllers\EventType;

Route::group(['prefix' => '/event_types'], function () {
    Route::get('/create', [EventType::class, 'create'])->name('event_types.create');

    Route::post('/', [EventType::class, 'store'])->name('event_types.store');

    Route::get('/{id}', [EventType::class, 'show'])->name('event_types.show');

    Route::post('/{id}', [EventType::class, 'update'])->name('event_types.update');

    Route::get('/', [EventType::class, 'index'])->name('event_types.index');
});
