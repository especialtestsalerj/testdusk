<?php

use App\Http\Controllers\Routine;
use App\Http\Livewire\Routines\Index as RoutinesIndex;

Route::group(['prefix' => '/routines'], function () {
    Route::get('/create', [Routine::class, 'create'])->name('routines.create');

    Route::post('/', [Routine::class, 'store'])->name('routines.store');

    Route::get('/{id}', [Routine::class, 'show'])->name('routines.show');

    Route::post('/{id}', [Routine::class, 'update'])->name('routines.update');

    Route::get('/', RoutinesIndex::class)->name('routines.index');

    Route::post('/finish/{id}', [Routine::class, 'finish'])->name('routines.finish');
});
