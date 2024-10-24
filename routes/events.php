<?php

use App\Http\Controllers\Event;
use App\Http\Livewire\Events\Index as EventsIndex;
use App\Http\Livewire\Events\Form as EventsForm;

Route::group(['prefix' => '/events'], function () {
    Route::get('', EventsIndex::class)
        ->name('events.index')
        ->middleware('canInCurrentBuilding:events:show');

    Route::get('/create', EventsForm::class)
        ->name('events.create')
        ->middleware('canInCurrentBuilding:events:store');

    Route::get('/{id}/show', EventsForm::class)
        ->name('events.show')
        ->middleware('canInCurrentBuilding:events:show');

    Route::group(
        [
            'middleware' => ['must-have-opened-routine'],
        ],
        function () {
            Route::post('', [Event::class, 'store'])
                ->name('events.store')
                ->middleware('canInCurrentBuilding:events:store');

            Route::post('/{id}', [Event::class, 'update'])
                ->name('events.update')
                ->middleware('canInCurrentBuilding:events:update');

            Route::post('/delete/{id}', [Event::class, 'destroy'])
                ->name('events.destroy')
                ->middleware('canInCurrentBuilding:events:destroy');
        }
    );
});
