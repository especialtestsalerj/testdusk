<?php

use App\Http\Controllers\EventType;
use App\Http\Livewire\EventTypes\Index as EventTypesIndex;

Route::group(['prefix' => '/event-types'], function () {
    //Criar
    Route::get('/create', [EventType::class, 'create'])
        ->name('event-types.create')
        ->can('event-types:store');

    Route::post('/', [EventType::class, 'store'])
        ->name('event-types.store')
        ->can('event-types:store');

    //Alterar
    Route::get('/{id}', [EventType::class, 'show'])
        ->name('event-types.show')
        ->can('event-types:show');

    Route::post('/{id}', [EventType::class, 'update'])
        ->name('event-types.update')
        ->can('event-types:update');

    //Visualizar
    Route::get('/', EventTypesIndex::class)
        ->name('event-types.index')
        ->can('event-types:show');

    //Remover
    Route::post('/delete/{id}', [EventType::class, 'delete'])
        ->name('event-types.delete')
        ->can('event-types:show');
});
