<?php

use App\Http\Controllers\Visitor;
use App\Http\Livewire\People\Index as PeopleIndex;
use App\Http\Livewire\Visitors\Index as VisitorsIndex;
use App\Http\Livewire\Visitors\VisitorsCard as VisitorsCard;

Route::group(['prefix' => '/visitors'], function () {
    Route::group(['prefix' => '/people'], function () {
        Route::get('', PeopleIndex::class)
            ->name('people.index')
            ->can('people:show');
    });

    Route::get('', VisitorsIndex::class)
        ->name('visitors.index')
        ->can('visitors:show');

    Route::get('/create', [Visitor::class, 'create'])
        ->name('visitors.create')
        ->can('visitors:store');

    Route::get('/{id}/card', VisitorsCard::class)
        ->name('visitors.card');

    Route::get('/{id}', [Visitor::class, 'show'])
        ->name('visitors.show')
        ->can('visitors:show');

    Route::post('', [Visitor::class, 'store'])
        ->name('visitors.store')
        ->can('visitors:store');

    Route::post('/{id}', [Visitor::class, 'update'])
        ->name('visitors.update')
        ->can('visitors:update');

    Route::post('/delete/{id}', [Visitor::class, 'destroy'])
        ->name('visitors.destroy')
        ->can('visitors:destroy');

});
