<?php
use App\Http\Controllers\NoAuth\Agendamento as Agendamento;


Route::group(['prefix' => 'agendamento'], function () {

    Route::get('/', [Agendamento::class,'create'])
        ->name('agendamento.index');

    Route::post('/',[Agendamento::class,'store'])
        ->name('agendamento.store');

    Route::post('/recover',[Agendamento::class,'recover'])
        ->name('agendamento.recover');
    Route::get('/detalhes', [Agendamento::class,'detail'])
        ->name('agendamento.detail');

    Route::group(['prefix' => 'agendamento-individual'], function () {

        Route::get('/', [Agendamento::class,'createTailwind'])
            ->name('agendamento.form-tailwind');
    });

    Route::get('/cancel/{uuid}', [Agendamento::class, 'cancel'])->name('reservation.cancel');

    Route::group(['prefix' => 'formulario'], function () {



        Route::post('/', [Agendamento::class,'createForm'])
            ->name('agendamento.form');
    });
});
