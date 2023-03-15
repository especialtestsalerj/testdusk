<?php

use App\Http\Controllers\Stuff;
use App\Http\Livewire\Stuffs\Index as StuffsIndex;

Route::group(['prefix' => '/stuffs'], function () {
    //Visualizar
    Route::get('', StuffsIndex::class)
        ->name('stuffs.index')
        ->can('stuffs:show');

    //Criar
    Route::get('/create', [Stuff::class, 'create'])
        ->name('stuffs.create')
        ->can('stuffs:store');

    //Alterar
    Route::get('/{id}', [Stuff::class, 'show'])
        ->name('stuffs.show')
        ->can('stuffs:show');

    Route::group(
        [
            'middleware' => ['must-have-opened-routine'],
        ],
        function () {
            //Criar
            Route::post('', [Stuff::class, 'store'])
                ->name('stuffs.store')
                ->can('stuffs:store');

            //Alterar
            Route::post('/{id}', [Stuff::class, 'update'])
                ->name('stuffs.update')
                ->can('stuffs:update');

            //Remover
            Route::delete('/{id}', [Stuff::class, 'destroy'])
                ->name('stuffs.destroy')
                ->can('stuffs:destroy');
        }
    );
});
