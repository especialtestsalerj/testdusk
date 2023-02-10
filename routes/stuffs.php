<?php

use App\Http\Controllers\Stuff;

Route::group(['prefix' => '/stuffs'], function () {
    //Criar
    Route::get('/create/{routine_id}', [Stuff::class, 'create'])
        ->name('stuffs.create')
        ->can('stuffs:store');

    Route::post('/', [Stuff::class, 'store'])
        ->name('stuffs.store')
        ->can('stuffs:store');

    //Alterar
    Route::get('/{id}', [Stuff::class, 'show'])
        ->name('stuffs.show')
        ->can('stuffs:show');

    Route::post('/{id}', [Stuff::class, 'update'])
        ->name('stuffs.update')
        ->can('stuffs:update');
});
