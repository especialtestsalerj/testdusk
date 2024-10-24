<?php

use App\Http\Controllers\EventType;
use App\Http\Livewire\EventTypes\Index as EventTypesIndex;

Route::group(['prefix' => '/event-types'], function () {
    Route::get('', EventTypesIndex::class)
        ->name('event-types.index')
        ->can('event-types:show');

    Route::get('/create', [EventType::class, 'create'])
        ->name('event-types.create')
        ->can('event-types:store');

    Route::post('', [EventType::class, 'store'])
        ->name('event-types.store')
        ->can('event-types:store');

    Route::get('/{id}/show', [EventType::class, 'show'])
        ->name('event-types.show')
        ->can('event-types:show');

    Route::post('/{id}', [EventType::class, 'update'])
        ->name('event-types.update')
        ->can('event-types:update');

    Route::post('/delete/{id}', [EventType::class, 'destroy'])
        ->name('event-types.destroy')
        ->can('event-types:destroy');
});
