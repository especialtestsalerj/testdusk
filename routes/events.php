<?php

use App\Http\Controllers\Event;

Route::group(['prefix' => '/events'], function () {
    //Criar
    Route::get('/create/{routine_id}', [Event::class, 'create'])
        ->name('events.create')
        ->can('events:store');

    Route::post('/', [Event::class, 'store'])
        ->name('events.store')
        ->can('events:store');

    //Alterar
    Route::get('/{id}', [Event::class, 'show'])
        ->name('events.show')
        ->can('events:show');

    Route::post('/{id}', [Event::class, 'update'])
        ->name('events.update')
        ->can('events:update');
});
