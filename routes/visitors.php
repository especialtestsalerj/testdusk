<?php

use App\Http\Controllers\Visitor;
use App\Http\Livewire\People\Index as PeopleIndex;
use App\Http\Livewire\Visitors\Index as VisitorsIndex;
use App\Http\Livewire\Visitors\Form as VisitorsForm;
use App\Http\Livewire\Visitors\UpdateForm as VisitorsUpdateForm;
use App\Http\Livewire\Visitors\Checkout;

Route::group(['prefix' => '/visitors'], function () {
    Route::group(['prefix' => '/people'], function () {
        Route::get('', PeopleIndex::class)
            ->name('people.index')
            ->can('people:show');
    });

    Route::get('/checkout', Checkout::class)->name('visitors.checkout');
    /*->can('visitors:show');*/

    Route::get('', VisitorsIndex::class)
        ->name('visitors.index')
        ->can('visitors:show');

    Route::get('/create', VisitorsForm::class)
        ->name('visitors.create')
        ->can('visitors:store');

    Route::get('/{visitor}/show', VisitorsUpdateForm::class)
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
