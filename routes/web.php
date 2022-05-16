<?php

use App\Http\Controllers\EventType;
use App\Http\Controllers\Sector;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| web routes
|--------------------------------------------------------------------------
|
| here is where you can register web routes for your application. these
| routes are loaded by the routeserviceprovider within a group which
| contains the "web" middleware group. now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(
    function () {
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard');
    }
);

//Route::resource('event_types', EventTypeController::class);
//Route::resource('sectors', SectorController::class);

Route::group(['prefix' => '/event_types'], function () {
    Route::get('/create', [EventType::class, 'create'])->name('event_types.create');

    Route::post('/', [EventType::class, 'store'])->name('event_types.store');

    Route::get('/{id}', [EventType::class, 'show'])->name('event_types.show');

    Route::post('/{id}', [EventType::class, 'update'])->name('event_types.update');

    Route::get('/', [EventType::class, 'index'])->name('event_types.index');
});

Route::group(['prefix' => '/sectors'], function () {
    Route::get('/create', [Sector::class, 'create'])->name('sectors.create');

    Route::post('/', [Sector::class, 'store'])->name('sectors.store');

    Route::get('/{id}', [Sector::class, 'show'])->name('sectors.show');

    Route::post('/{id}', [Sector::class, 'update'])->name('sectors.update');

    Route::get('/', [Sector::class, 'index'])->name('sectors.index');
});
