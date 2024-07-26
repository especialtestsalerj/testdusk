<?php
use App\Http\Controllers\NoAuth\Agendamento as Agendamento;


Route::group(['prefix' => 'agendamento'], function () {

    Route::get('/', [Agendamento::class,'create'])
        ->name('agendamento.index');

    Route::post('/',[Agendamento::class,'store'])
        ->name('agendamento.store');
    Route::get('/detalhes', [Agendamento::class,'detail'])
        ->name('agendamento.detail');

    Route::group(['prefix' => 'agendamento-individual'], function () {

        Route::get('/', [Agendamento::class,'createTailwind'])
            ->name('agendamento.form-tailwind');
    });

    Route::group(['prefix' => 'agendamento-grupo'], function () {

        Route::get('/', [Agendamento::class,'createGroup'])
            ->name('agendamento.form-group');
    });
});
