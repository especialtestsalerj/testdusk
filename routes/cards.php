<?php

use App\Http\Controllers\Cards;
use App\Http\Livewire\Cards\Index as CardsIndex;

Route::group(['prefix' => '/cards'], function () {
    Route::get('/download', [Cards::class, 'download'])
        ->name('cards.download')
        ->can('cards:download');

    Route::get('', CardsIndex::class)
        ->name('cards.index')
        ->middleware('canInCurrentBuilding:cards:index');

    Route::get('/create', [Cards::class, 'create'])
        ->name('cards.create')
        ->middleware('canInCurrentBuilding:cards:store');

    Route::post('', [Cards::class, 'store'])
        ->name('cards.store')
        ->middleware('canInCurrentBuilding:cards:store');

    Route::get('/{id}/show', [Cards::class, 'show'])
        ->name('cards.show')
        ->middleware('canInCurrentBuilding:cards:show');

    Route::post('/{id}', [Cards::class, 'update'])
        ->name('cards.update')
        ->middleware('canInCurrentBuilding:cards:update');
});
