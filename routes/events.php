<?php

use App\Http\Controllers\Event;
use App\Http\Livewire\Events\Index as EventsIndex;

Route::group(['prefix' => '/events'], function () {
    //Criar (Rotina)
    Route::get('/create/{routine_id}', [Event::class, 'create'])
        ->name('events.create')
        ->can('events:store');

    //Alterar (Rotina)
    Route::get('/{id}', [Event::class, 'show'])
        ->name('events.show')
        ->can('events:show');

    //Criar (Dashboard)
    Route::get('/index/create/{routine_id}', [Event::class, 'createFromDashboard'])
        ->name('events.createFromDashboard')
        ->can('events:store');

    //Alterar (Dashboard)
    Route::get('/index/show/{routine_id}/{id}', [Event::class, 'showFromDashboard'])
        ->name('events.showFromDashboard')
        ->can('events:show');

    //Visualizar (Dashboard)
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

            //Criar (Dashboard)
            Route::post('/index/create/{routine_id}', [Event::class, 'storeFromDashboard'])
                ->name('events.storeFromDashboard')
                ->can('events:store');

            //Alterar (Dashboard)
            Route::post('/index/show/{routine_id}/{id}', [Event::class, 'updateFromDashboard'])
                ->name('events.updateFromDashboard')
                ->can('events:update');

            //Remover (Dashboard)
            Route::post('/index/delete/{id}', [Event::class, 'deleteFromDashboard'])
                ->name('events.deleteFromDashboard')
                ->can('events:show');
        }
    );
});
