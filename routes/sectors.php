<?php

use App\Http\Controllers\Sector;
use App\Http\Livewire\Sectors\Index as SectorsIndex;

Route::group(['prefix' => '/sectors'], function () {
    Route::get('/create', [Sector::class, 'create'])->name('sectors.create');

    Route::post('/', [Sector::class, 'store'])->name('sectors.store');

    Route::get('/{id}', [Sector::class, 'show'])->name('sectors.show');

    Route::post('/{id}', [Sector::class, 'update'])->name('sectors.update');

    Route::get('/', SectorsIndex::class)->name('sectors.index');
});
