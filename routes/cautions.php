<?php

use App\Http\Controllers\Caution;

Route::group(['prefix' => '/cautions'], function () {
    //Criar
    Route::get('/create/{routine_id}', [Caution::class, 'create'])
        ->name('cautions.create')
        ->can('cautions:store');

    Route::post('/', [Caution::class, 'store'])
        ->name('cautions.store')
        ->can('cautions:store');

    //Alterar
    Route::get('/{id}', [Caution::class, 'show'])
        ->name('cautions.show')
        ->can('cautions:show');

    Route::post('/{id}', [Caution::class, 'update'])
        ->name('cautions.update')
        ->can('cautions:update');
});
