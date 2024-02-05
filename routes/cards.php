<?php

use App\Http\Controllers\Cards;
use App\Http\Livewire\Cards\Index as CardsIndex;

Route::group(['prefix' => '/cards'], function () {
    Route::get('/download', [Cards::class, 'download'])
        ->name('cards.download')
        ->can('cards:download');

    Route::get('', CardsIndex::class)
        ->name('cards.index')
        ->middleware('canInCurrentBuilding:cards:show');

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

    Route::post('/delete/{id}', [Cards::class, 'destroy'])
        ->name('cards.destroy')
        ->middleware('canInCurrentBuilding:cards:destroy');

    Route::post('/disable-all', [Cards::class, 'disableAll'])
        ->name('cards.disable_all')
        ->middleware('canInCurrentBuilding:cards:disable-all');

    Route::post('/enable-all', [Cards::class, 'enableAll'])
        ->name('cards.enable_all')
        ->middleware('canInCurrentBuilding:cards:enable-all');
});
