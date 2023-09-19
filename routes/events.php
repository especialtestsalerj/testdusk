<?php

use App\Http\Controllers\Event;
use App\Http\Livewire\Events\Index as EventsIndex;

Route::group(['prefix' => '/events'], function () {
    Route::get('', EventsIndex::class)
        ->name('events.index')
        ->can('events:show');

    Route::get('/create', [Event::class, 'create'])
        ->name('events.create')
        ->can('events:store');

    Route::get('/{id}/show', [Event::class, 'show'])
        ->name('events.show')
        ->can('events:show');

    Route::group(
        [
            'middleware' => ['must-have-opened-routine'],
        ],
        function () {
            Route::post('', [Event::class, 'store'])
                ->name('events.store')
                ->can('events:store');

            Route::post('/{id}', [Event::class, 'update'])
                ->name('events.update')
                ->can('events:update');

            Route::post('/delete/{id}', [Event::class, 'destroy'])
                ->name('events.destroy')
                ->can('events:destroy');
        }
    );
});
