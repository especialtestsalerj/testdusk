<?php

use App\Http\Controllers\Sector;
use App\Http\Livewire\Sectors\Index as SectorsIndex;

Route::group(['prefix' => '/sectors'], function () {
    Route::get('', SectorsIndex::class)
        ->name('sectors.index')
        ->middleware('canInCurrentBuilding:sectors:show');

    Route::get('/create', [Sector::class, 'create'])
        ->name('sectors.create')
        ->middleware('canInCurrentBuilding:sectors:store');

    Route::post('', [Sector::class, 'store'])
        ->name('sectors.store')
        ->middleware('canInCurrentBuilding:sectors:store');

    Route::get('/{id}/show', [Sector::class, 'show'])
        ->name('sectors.show')
        ->middleware('canInCurrentBuilding:sectors:show');

    Route::post('/{id}', [Sector::class, 'update'])
        ->name('sectors.update')
        ->middleware('canInCurrentBuilding:sectors:update');

    Route::post('/delete/{id}', [Sector::class, 'destroy'])
        ->name('sectors.destroy')
        ->middleware('canInCurrentBuilding:sectors:destroy');
});
