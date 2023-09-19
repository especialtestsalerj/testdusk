<?php

use App\Http\Controllers\PersonRestriction;
use App\Http\Livewire\PersonRestrictions\Index as PersonRestrictionsIndex;

Route::group(['prefix' => '/person-restrictions'], function () {
    Route::get('', PersonRestrictionsIndex::class)
        ->name('person-restrictions.index')
        ->can('person-restrictions:show');

    Route::get('/create', [PersonRestriction::class, 'create'])
        ->name('person-restrictions.create')
        ->can('person-restrictions:store');

    Route::post('', [PersonRestriction::class, 'store'])
        ->name('person-restrictions.store')
        ->can('person-restrictions:store');

    Route::get('/{id}/show', [PersonRestriction::class, 'show'])
        ->name('person-restrictions.show')
        ->can('person-restrictions:show');

    Route::post('/{id}', [PersonRestriction::class, 'update'])
        ->name('person-restrictions.update')
        ->can('person-restrictions:update');

    Route::post('/delete/{id}', [PersonRestriction::class, 'destroy'])
        ->name('person-restrictions.destroy')
        ->can('person-restrictions:destroy');
});
