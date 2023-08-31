<?php

use App\Http\Controllers\CertificateType;
use App\Http\Livewire\CertificateTypes\Index as CertificateTypesIndex;

Route::group(['prefix' => '/certificate-types'], function () {
    Route::get('', CertificateTypesIndex::class)
        ->name('certificate-types.index')
        ->can('certificate-types:show');

    Route::get('/create', [CertificateType::class, 'create'])
        ->name('certificate-types.create')
        ->can('certificate-types:store');

    Route::post('', [CertificateType::class, 'store'])
        ->name('certificate-types.store')
        ->can('certificate-types:store');

    Route::get('/{id}', [CertificateType::class, 'show'])
        ->name('certificate-types.show')
        ->can('certificate-types:show');

    Route::post('/{id}', [CertificateType::class, 'update'])
        ->name('certificate-types.update')
        ->can('certificate-types:update');

    Route::post('/delete/{id}', [CertificateType::class, 'destroy'])
        ->name('certificate-types.destroy')
        ->can('certificate-types:destroy');
});
