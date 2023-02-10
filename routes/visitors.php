<?php

use App\Http\Controllers\Visitor;

Route::group(['prefix' => '/visitors'], function () {
    //Criar
    Route::get('/create/{routine_id}', [Visitor::class, 'create'])
        ->name('visitors.create')
        ->can('visitors:store');

    Route::post('/', [Visitor::class, 'store'])
        ->name('visitors.store')
        ->can('visitors:store');

    //Alterar
    Route::get('/{id}', [Visitor::class, 'show'])
        ->name('visitors.show')
        ->can('visitors:show');

    Route::post('/{id}', [Visitor::class, 'update'])
        ->name('visitors.update')
        ->can('visitors:update');
});
