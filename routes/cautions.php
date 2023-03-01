<?php

use App\Http\Controllers\Caution;
use App\Http\Livewire\Cautions\Index as CautionsIndex;

Route::group(['prefix' => '/cautions'], function () {
    //Criar (Rotina)
    Route::get('/create/{routine_id}', [Caution::class, 'create'])
        ->name('cautions.create')
        ->can('cautions:store');

    //Alterar (Rotina)
    Route::get('/{id}', [Caution::class, 'show'])
        ->name('cautions.show')
        ->can('cautions:show');

    //Criar (Dashboard)
    Route::get('/index/create/{routine_id}', [Caution::class, 'createFromDashboard'])
        ->name('cautions.createFromDashboard')
        ->can('cautions:store');

    //Alterar (Dashboard)
    Route::get('/index/show/{routine_id}/{id}', [Caution::class, 'showFromDashboard'])
        ->name('cautions.showFromDashboard')
        ->can('cautions:show');

    //Visualizar (Dashboard)
    Route::get('/index/{routine_id}', CautionsIndex::class)
        ->name('cautions.index')
        ->can('cautions:show');

    Route::group(
        [
            'middleware' => ['must-have-opened-routine'],
        ],
        function () {
            //Criar (Rotina)
            Route::post('/', [Caution::class, 'store'])
                ->name('cautions.store')
                ->can('cautions:store');

            //Alterar (Rotina)
            Route::post('/{id}', [Caution::class, 'update'])
                ->name('cautions.update')
                ->can('cautions:update');

            //Remover (Rotina)
            Route::post('/delete/{id}', [Caution::class, 'delete'])
                ->name('cautions.delete')
                ->can('cautions:show');

            //Criar (Dashboard)
            Route::post('/index/create/{routine_id}', [Caution::class, 'storeFromDashboard'])
                ->name('cautions.storeFromDashboard')
                ->can('cautions:store');

            //Alterar (Dashboard)
            Route::post('/index/show/{routine_id}/{id}', [Caution::class, 'updateFromDashboard'])
                ->name('cautions.updateFromDashboard')
                ->can('cautions:update');

            //Remover (Dashboard)
            Route::post('/index/delete/{id}', [Caution::class, 'deleteFromDashboard'])
                ->name('cautions.deleteFromDashboard')
                ->can('cautions:show');
        }
    );
});
