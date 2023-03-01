<?php

use App\Http\Controllers\Visitor;
use App\Http\Livewire\Visitors\Index as VisitorsIndex;

Route::group(['prefix' => '/visitors'], function () {
    //Criar (Rotina)
    Route::get('/create/{routine_id}', [Visitor::class, 'create'])
        ->name('visitors.create')
        ->can('visitors:store');

    //Alterar (Rotina)
    Route::get('/{id}', [Visitor::class, 'show'])
        ->name('visitors.show')
        ->can('visitors:show');

    //Criar (Dashboard)
    Route::get('/index/create/{routine_id}', [Visitor::class, 'createFromDashboard'])
        ->name('visitors.createFromDashboard')
        ->can('visitors:store');

    //Alterar (Dashboard)
    Route::get('/index/show/{routine_id}/{id}', [Visitor::class, 'showFromDashboard'])
        ->name('visitors.showFromDashboard')
        ->can('visitors:show');

    //Visualizar (Dashboard)
    Route::get('/index/{routine_id}', VisitorsIndex::class)
        ->name('visitors.index')
        ->can('visitors:show');

    Route::group(
        [
            'middleware' => ['must-have-opened-routine'],
        ],
        function () {
            //Criar (Rotina)
            Route::post('/', [Visitor::class, 'store'])
                ->name('visitors.store')
                ->can('visitors:store');

            //Alterar (Rotina)
            Route::post('/{id}', [Visitor::class, 'update'])
                ->name('visitors.update')
                ->can('visitors:update');

            //Remover (Rotina)
            Route::post('/delete/{id}', [Visitor::class, 'delete'])
                ->name('visitors.delete')
                ->can('visitors:show');

            //Criar (Dashboard)
            Route::post('/index/create/{routine_id}', [Visitor::class, 'storeFromDashboard'])
                ->name('visitors.storeFromDashboard')
                ->can('visitors:store');

            //Alterar (Dashboard)
            Route::post('/index/show/{routine_id}/{id}', [Visitor::class, 'updateFromDashboard'])
                ->name('visitors.updateFromDashboard')
                ->can('visitors:update');

            //Remover (Dashboard)
            Route::post('/index/delete/{id}', [Visitor::class, 'deleteFromDashboard'])
                ->name('visitors.deleteFromDashboard')
                ->can('visitors:show');
        }
    );
});
