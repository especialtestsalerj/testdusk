<?php

use App\Http\Controllers\PersonRestriction;
use App\Http\Livewire\PersonRestrictions\Index as PersonRestrictionsIndex;

Route::group(['prefix' => '/person-restrictions'], function () {
    Route::get('', PersonRestrictionsIndex::class)
        ->name('person-restrictions.index')
        ->middleware('canInCurrentBuilding:person-restrictions:show');

    Route::get('/create', [PersonRestriction::class, 'create'])
        ->name('person-restrictions.create')
        ->middleware('canInCurrentBuilding:person-restrictions:store');

    Route::post('', [PersonRestriction::class, 'store'])
        ->name('person-restrictions.store')
        ->middleware('canInCurrentBuilding:person-restrictions:store');

    Route::get('/{id}/show', [PersonRestriction::class, 'show'])
        ->name('person-restrictions.show')
        ->middleware('canInCurrentBuilding:person-restrictions:show');

    Route::post('/{id}', [PersonRestriction::class, 'update'])
        ->name('person-restrictions.update')
        ->middleware('canInCurrentBuilding:person-restrictions:update');

    Route::post('/delete/{id}', [PersonRestriction::class, 'destroy'])
        ->name('person-restrictions.destroy')
        ->middleware('canInCurrentBuilding:person-restrictions:destroy');
});
