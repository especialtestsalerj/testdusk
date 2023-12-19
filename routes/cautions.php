<?php

use App\Http\Controllers\Caution;
use App\Http\Livewire\Cautions\CreateForm as CautionsCreateForm;
use App\Http\Livewire\Cautions\UpdateForm as CautionsUpdateForm;
use App\Http\Livewire\Cautions\Index as CautionsIndex;

Route::group(['prefix' => '/cautions'], function () {
    Route::get('', CautionsIndex::class)
        ->name('cautions.index')
        ->middleware('canInCurrentBuilding:cautions:show');

    Route::get('/create', CautionsCreateForm::class)
        ->name('cautions.create')
        ->middleware('canInCurrentBuilding:cautions:store');

    Route::get('/{caution}/show', CautionsUpdateForm::class)
        ->name('cautions.show')
        ->middleware('canInCurrentBuilding:cautions:show');

    Route::get('/{id}/receipt', [Caution::class, 'receipt'])
        ->name('cautions.receipt')
        ->middleware('canInCurrentBuilding:cautions:show');

    Route::group(
        [
            'middleware' => ['must-have-opened-routine'],
        ],
        function () {
            Route::post('', [Caution::class, 'store'])
                ->name('cautions.store')
                ->middleware('canInCurrentBuilding:cautions:store');

            Route::post('/{id}', [Caution::class, 'update'])
                ->name('cautions.update')
                ->middleware('canInCurrentBuilding:cautions:update');

            Route::post('/delete/{id}', [Caution::class, 'destroy'])
                ->name('cautions.destroy')
                ->middleware('canInCurrentBuilding:cautions:destroy');
        }
    );
});
