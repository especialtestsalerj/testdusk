<?php

use App\Http\Controllers\Routine;

use App\Http\Livewire\Routines\Index as RoutinesIndex;

Route::group(['prefix' => '/routines'], function () {
    Route::get('', RoutinesIndex::class)
        ->name('routines.index')
        ->middleware('canInCurrentBuilding:routines:show');

    Route::get('/create', [Routine::class, 'create'])
        ->name('routines.create')
        ->middleware('canInCurrentBuilding:routines:store');

    Route::post('', [Routine::class, 'store'])
        ->name('routines.store')
        ->middleware('canInCurrentBuilding:routines:store');

    Route::get('/{id}/show', [Routine::class, 'show'])
        ->name('routines.show')
        ->middleware('canInCurrentBuilding:routines:show');

    Route::post('/{id}', [Routine::class, 'update'])
        ->name('routines.update')
        ->middleware('canInCurrentBuilding:routines:update');

    Route::post('/finish/{id}', [Routine::class, 'finish'])
        ->name('routines.finish')
        ->middleware('canInCurrentBuilding:routines:show');
});
