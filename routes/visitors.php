<?php

use App\Http\Controllers\Visitor;
use App\Http\Livewire\Visitors\Index as VisitorsIndex;

Route::group(['prefix' => '/visitors'], function () {
    Route::get('', VisitorsIndex::class)
        ->name('visitors.index')
        ->can('visitors:show');

    Route::get('/create', [Visitor::class, 'create'])
        ->name('visitors.create')
        ->can('visitors:store');

    Route::get('/{id}', [Visitor::class, 'show'])
        ->name('visitors.show')
        ->can('visitors:show');

    Route::group(
        [
            'middleware' => ['must-have-opened-routine'],
        ],
        function () {
            Route::post('', [Visitor::class, 'store'])
                ->name('visitors.store')
                ->can('visitors:store');

            Route::post('/{id}', [Visitor::class, 'update'])
                ->name('visitors.update')
                ->can('visitors:update');

            Route::post('/delete/{id}', [Visitor::class, 'destroy'])
                ->name('visitors.destroy')
                ->can('visitors:destroy');
        }
    );
});
