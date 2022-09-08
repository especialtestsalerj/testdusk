<?php

use App\Http\Controllers\Caution;

Route::group(['prefix' => '/cautions'], function () {
    Route::get('/create/{routine_id}', [Caution::class, 'create'])->name('cautions.create');

    Route::post('/', [Caution::class, 'store'])->name('cautions.store');

    Route::get('/{id}', [Caution::class, 'show'])->name('cautions.show');

    Route::post('/{id}', [Caution::class, 'update'])->name('cautions.update');
});
