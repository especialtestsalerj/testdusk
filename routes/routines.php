<?php

use App\Http\Controllers\Routine;
use App\Http\Livewire\Routines\Index as RoutinesIndex;

Route::group(['prefix' => '/routines'], function () {
    //Visualizar
    Route::get('', RoutinesIndex::class)
        ->name('routines.index')
        ->can('routines:show');

    //Criar
    Route::get('/create', [Routine::class, 'create'])
        ->name('routines.create')
        ->can('routines:store');

    Route::post('', [Routine::class, 'store'])
        ->name('routines.store')
        ->can('routines:store');

    //Alterar
    Route::get('/{id}', [Routine::class, 'show'])
        ->name('routines.show')
        ->can('routines:show');

    Route::post('/{id}', [Routine::class, 'update'])
        ->name('routines.update')
        ->can('routines:update');

    //Finalizar
    Route::post('/finish/{id}', [Routine::class, 'finish'])
        ->name('routines.finish')
        ->can('routines:show');
});
