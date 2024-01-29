<?php

use App\Http\Controllers\Cards;

Route::group(['prefix' => '/cards'], function () {
    Route::get('/download', [Cards::class, 'download'])
        ->name('cards.download')
        ->can('cards:download');
});
