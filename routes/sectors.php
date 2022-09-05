<?php

use App\Http\Controllers\Sector;

Route::group(['prefix' => '/sectors'], function () {
    Route::get('/create', [Sector::class, 'create'])->name('sectors.create');

    Route::post('/', [Sector::class, 'store'])->name('sectors.store');

    Route::get('/{id}', [Sector::class, 'show'])->name('sectors.show');

    Route::post('/{id}', [Sector::class, 'update'])->name('sectors.update');

    Route::get('/', [Sector::class, 'index'])->name('sectors.index');
});
