<?php

use App\Http\Controllers\Routine;

Route::group(['prefix' => '/routines'], function () {
    Route::get('/create', [Routine::class, 'create'])->name('routines.create');

    Route::post('/', [Routine::class, 'store'])->name('routines.store');

    Route::get('/{id}', [Routine::class, 'show'])->name('routines.show');

    Route::post('/{id}', [Routine::class, 'update'])->name('routines.update');

    Route::get('/', [Routine::class, 'index'])->name('routines.index');
});
