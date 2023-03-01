<?php

use App\Http\Controllers\Stuff;
use App\Http\Livewire\Stuffs\Index as StuffsIndex;

Route::group(['prefix' => '/stuffs'], function () {
    //Criar (Rotina)
    Route::get('/create/{routine_id}', [Stuff::class, 'create'])
        ->name('stuffs.create')
        ->can('stuffs:store');

    //Alterar (Rotina)
    Route::get('/{id}', [Stuff::class, 'show'])
        ->name('stuffs.show')
        ->can('stuffs:show');

    //Criar (Dashboard)
    Route::get('/index/create/{routine_id}', [Stuff::class, 'createFromDashboard'])
        ->name('stuffs.createFromDashboard')
        ->can('stuffs:store');

    //Alterar (Dashboard)
    Route::get('/index/show/{routine_id}/{id}', [Stuff::class, 'showFromDashboard'])
        ->name('stuffs.showFromDashboard')
        ->can('stuffs:show');

    //Visualizar (Dashboard)
    Route::get('/index/{routine_id}', StuffsIndex::class)
        ->name('stuffs.index')
        ->can('stuffs:show');

    Route::group(
        [
            'middleware' => ['must-have-opened-routine'],
        ],
        function () {
            //Criar (Rotina)
            Route::post('/', [Stuff::class, 'store'])
                ->name('stuffs.store')
                ->can('stuffs:store');

            //Alterar (Rotina)
            Route::post('/{id}', [Stuff::class, 'update'])
                ->name('stuffs.update')
                ->can('stuffs:update');

            //Remover (Rotina)
            Route::post('/delete/{id}', [Stuff::class, 'delete'])
                ->name('stuffs.delete')
                ->can('stuffs:show');

            //Criar (Dashboard)
            Route::post('/index/create/{routine_id}', [Stuff::class, 'storeFromDashboard'])
                ->name('stuffs.storeFromDashboard')
                ->can('stuffs:store');

            //Alterar (Dashboard)
            Route::post('/index/show/{routine_id}/{id}', [Stuff::class, 'updateFromDashboard'])
                ->name('stuffs.updateFromDashboard')
                ->can('stuffs:update');

            //Remover (Dashboard)
            Route::post('/index/delete/{id}', [Stuff::class, 'deleteFromDashboard'])
                ->name('stuffs.deleteFromDashboard')
                ->can('stuffs:show');
        }
    );
});
