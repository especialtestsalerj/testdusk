<?php

use App\Http\Controllers\EventType;
use App\Http\Livewire\EventTypes\Index as EventTypesIndex;

Route::group(['prefix' => '/event-types'], function () {
    Route::get('/create', [EventType::class, 'create'])->name('event-types.create');

    Route::post('/', [EventType::class, 'store'])->name('event-types.store');

    Route::get('/{id}', [EventType::class, 'show'])->name('event-types.show');

    Route::post('/{id}', [EventType::class, 'update'])->name('event-types.update');

    Route::get('/', EventTypesIndex::class)->name('event-types.index');
});
