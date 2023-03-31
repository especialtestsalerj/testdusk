<?php

use App\Http\Controllers\Event;
use App\Http\Livewire\Events\Index as EventsIndex;

Route::group(['prefix' => '/events'], function () {
    //Visualizar
    Route::get('', EventsIndex::class)
        ->name('events.index')
        ->can('events:show');

    //Criar
    Route::get('/create', [Event::class, 'create'])
        ->name('events.create')
        ->can('events:store');

    //Alterar
    Route::get('/{id}', [Event::class, 'show'])
        ->name('events.show')
        ->can('events:show');

    Route::group(
        [
            'middleware' => ['must-have-opened-routine'],
        ],
        function () {
            //Criar
            Route::post('', [Event::class, 'store'])
                ->name('events.store')
                ->can('events:store');

            //Alterar
            Route::post('/{id}', [Event::class, 'update'])
                ->name('events.update')
                ->can('events:update');

            //Remover
            Route::post('/delete/{id}', [Event::class, 'destroy'])
                ->name('events.destroy')
                ->can('events:destroy');
        }
    );
});
