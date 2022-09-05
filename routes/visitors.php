<?php

use App\Http\Controllers\Visitor;

Route::group(['prefix' => '/visitors'], function () {
    Route::get('/create/{routine_id}', [Visitor::class, 'create'])->name('visitors.create');

    Route::post('/', [Visitor::class, 'store'])->name('visitors.store');

    Route::get('/{id}', [Visitor::class, 'show'])->name('visitors.show');

    Route::post('/{id}', [Visitor::class, 'update'])->name('visitors.update');
});
