<?php

use App\Http\Controllers\Stuff;
use App\Http\Livewire\Stuffs\Index as StuffsIndex;

Route::group(['prefix' => '/stuffs'], function () {
    Route::get('', StuffsIndex::class)
        ->name('stuffs.index')
        ->can('stuffs:show');

    Route::get('/create', [Stuff::class, 'create'])
        ->name('stuffs.create')
        ->can('stuffs:store');

    Route::get('/{id}/show', [Stuff::class, 'show'])
        ->name('stuffs.show')
        ->can('stuffs:show');

    Route::group(
        [
            'middleware' => ['must-have-opened-routine'],
        ],
        function () {
            Route::post('', [Stuff::class, 'store'])
                ->name('stuffs.store')
                ->can('stuffs:store');

            Route::post('/{id}', [Stuff::class, 'update'])
                ->name('stuffs.update')
                ->can('stuffs:update');

            Route::post('/delete/{id}', [Stuff::class, 'destroy'])
                ->name('stuffs.destroy')
                ->can('stuffs:destroy');
        }
    );
});
