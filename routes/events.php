<?php

use App\Http\Controllers\Event;
use App\Http\Livewire\Events\Index as EventsIndex;

Route::group(['prefix' => '/events'], function () {
    //Criar
    Route::get('/create/{routine_id}', [Event::class, 'create'])
        ->name('events.create')
        ->can('events:store');

    //Alterar
    Route::get('/{id}', [Event::class, 'show'])
        ->name('events.show')
        ->can('events:show');

    //Visualizar
    Route::get('/index/{routine_id}', EventsIndex::class)
        ->name('events.index')
        ->can('events:show');

    Route::group(
        [
            'middleware' => ['must-have-opened-routine'],
        ],
        function () {
            //Criar (Rotina)
            Route::post('/', [Event::class, 'store'])
                ->name('events.store')
                ->can('events:store');

            //Alterar (Rotina)
            Route::post('/{id}', [Event::class, 'update'])
                ->name('events.update')
                ->can('events:update');

            //Remover (Rotina)
            Route::post('/delete/{id}', [Event::class, 'delete'])
                ->name('events.delete')
                ->can('events:show');
        }
    );
});
