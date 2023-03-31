<?php

use App\Http\Controllers\Caution;
use App\Http\Livewire\Cautions\Index as CautionsIndex;

Route::group(['prefix' => '/cautions'], function () {
    //Visualizar
    Route::get('', CautionsIndex::class)
        ->name('cautions.index')
        ->can('cautions:show');

    //Criar
    Route::get('/create', [Caution::class, 'create'])
        ->name('cautions.create')
        ->can('cautions:store');

    //Alterar
    Route::get('/{id}', [Caution::class, 'show'])
        ->name('cautions.show')
        ->can('cautions:show');

    //Comprovante
    Route::get('/{id}/receipt', [Caution::class, 'receipt'])
        ->name('cautions.receipt')
        ->can('cautions:show');

    Route::group(
        [
            'middleware' => ['must-have-opened-routine'],
        ],
        function () {
            //Criar
            Route::post('', [Caution::class, 'store'])
                ->name('cautions.store')
                ->can('cautions:store');

            //Alterar
            Route::post('/{id}', [Caution::class, 'update'])
                ->name('cautions.update')
                ->can('cautions:update');

            //Remover
            Route::post('/delete/{id}', [Caution::class, 'destroy'])
                ->name('cautions.destroy')
                ->can('cautions:destroy');
        }
    );
});
