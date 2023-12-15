<?php

use App\Http\Controllers\Visitor;
use App\Http\Livewire\Visitors\Index as VisitorsIndex;
use App\Http\Livewire\Visitors\Form as VisitorsForm;
use App\Http\Livewire\Visitors\UpdateForm as VisitorsUpdateForm;
use App\Http\Livewire\Visitors\Checkout;
use App\Http\Middleware\CanInCurrentBuilding;

Route::group(['prefix' => '/visitors'], function () {
    Route::get('/checkout', Checkout::class)
        ->name('visitors.checkout')
        ->middleware('canInCurrentBuilding:visitors:checkout');
    /*->can('visitors:show');*/

    Route::get('', VisitorsIndex::class)
        ->name('visitors.index')
        ->middleware('canInCurrentBuilding:visitors:show');

    Route::get('/create', VisitorsForm::class)
        ->name('visitors.create')
        ->middleware('canInCurrentBuilding:visitors:store');

    Route::get('/{visitor}/show', VisitorsUpdateForm::class)
        ->name('visitors.show')
        ->middleware('canInCurrentBuilding:visitors:show');

    Route::post('/checkout-all', [Visitor::class, 'checkoutAll'])
        ->name('visitors.checkout_all')
        ->middleware('canInCurrentBuilding:visitors:checkout-all');

    Route::post('', [Visitor::class, 'store'])
        ->name('visitors.store')
        ->middleware('canInCurrentBuilding:visitors:store');

    Route::post('/{id}', [Visitor::class, 'update'])
        ->name('visitors.update')
        ->middleware('canInCurrentBuilding:visitors:update');
});
