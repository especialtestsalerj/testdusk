<?php

use App\Http\Controllers\Caution;
use App\Http\Livewire\Cautions\CreateForm as CautionsCreateForm;
use App\Http\Livewire\Cautions\UpdateForm as CautionsUpdateForm;
use App\Http\Livewire\Cautions\Index as CautionsIndex;

Route::group(['prefix' => '/cautions'], function () {
    Route::get('', CautionsIndex::class)
        ->name('cautions.index')
        ->can('cautions:show');

    Route::get('/create', CautionsCreateForm::class)
        ->name('cautions.create')
        ->can('cautions:store');

    Route::get('/{caution}/show', CautionsUpdateForm::class)
        ->name('cautions.show')
        ->can('cautions:show');

    Route::get('/{id}/receipt', [Caution::class, 'receipt'])
        ->name('cautions.receipt')
        ->can('cautions:show');

    Route::group(
        [
            'middleware' => ['must-have-opened-routine'],
        ],
        function () {
            Route::post('', [Caution::class, 'store'])
                ->name('cautions.store')
                ->can('cautions:store');

            Route::post('/{id}', [Caution::class, 'update'])
                ->name('cautions.update')
                ->can('cautions:update');

            Route::post('/delete/{id}', [Caution::class, 'destroy'])
                ->name('cautions.destroy')
                ->can('cautions:destroy');
        }
    );
});
