<?php

use App\Http\Controllers\Stuff;

Route::group(['prefix' => '/stuffs'], function () {
    Route::get('/create/{routine_id}', [Stuff::class, 'create'])->name('stuffs.create');

    Route::post('/', [Stuff::class, 'store'])->name('stuffs.store');

    Route::get('/{id}', [Stuff::class, 'show'])->name('stuffs.show');

    Route::post('/{id}', [Stuff::class, 'update'])->name('stuffs.update');
});
