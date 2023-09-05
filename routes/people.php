<?php

use App\Http\Controllers\Person;
use App\Http\Livewire\People\Index as PeopleIndex;
use App\Http\Livewire\People\Form as PeopleForm;

Route::group(['prefix' => '/people'], function () {
    Route::get('', PeopleIndex::class)
        ->name('people.index')
        ->can('people:show');

    Route::get('/{id}/show', PeopleForm::class)
        ->name('people.form')
        ->can('people:show');

    Route::post('/create', [Person::class, 'create'])
        ->name('people.create');

    Route::post('/{id}', [Person::class, 'update'])
        ->name('people.update')
        ->can('people:update');


});
