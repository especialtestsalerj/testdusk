<?php

use App\Http\Controllers\Sector;
use App\Http\Livewire\Sectors\Index as SectorsIndex;

Route::group(['prefix' => '/sectors'], function () {
    Route::get('', SectorsIndex::class)
        ->name('sectors.index')
        ->can('sectors:show');

    Route::get('/create', [Sector::class, 'create'])
        ->name('sectors.create')
        ->can('sectors:store');

    Route::post('', [Sector::class, 'store'])
        ->name('sectors.store')
        ->can('sectors:store');

    Route::get('/{id}', [Sector::class, 'show'])
        ->name('sectors.show')
        ->can('sectors:show');

    Route::post('/{id}', [Sector::class, 'update'])
        ->name('sectors.update')
        ->can('sectors:update');

    Route::post('/delete/{id}', [Sector::class, 'destroy'])
        ->name('sectors.destroy')
        ->can('sectors:destroy');
});
