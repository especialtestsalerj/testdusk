<?php

use App\Http\Controllers\Visitor;
use App\Http\Livewire\Visitors\Index as VisitorsIndex;

Route::group(['prefix' => '/visitors'], function () {
    //Visualizar
    Route::get('', VisitorsIndex::class)
        ->name('visitors.index')
        ->can('visitors:show');

    //Criar
    Route::get('/create', [Visitor::class, 'create'])
        ->name('visitors.create')
        ->can('visitors:store');

    //Alterar
    Route::get('/{id}', [Visitor::class, 'show'])
        ->name('visitors.show')
        ->can('visitors:show');

    Route::group(
        [
            'middleware' => ['must-have-opened-routine'],
        ],
        function () {
            //Criar
            Route::post('', [Visitor::class, 'store'])
                ->name('visitors.store')
                ->can('visitors:store');

            //Alterar
            Route::post('/{id}', [Visitor::class, 'update'])
                ->name('visitors.update')
                ->can('visitors:update');

            //Remover
            Route::post('/delete/{id}', [Visitor::class, 'destroy'])
                ->name('visitors.destroy')
                ->can('visitors:destroy');
        }
    );
});
