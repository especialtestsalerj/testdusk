<?php

use App\Http\Controllers\EventType;
use App\Http\Controllers\Sector;
use App\Http\Controllers\Routine;
use App\Http\Controllers\Dashboard;
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
    return view('/auth/login');
});

Route::get('/logout', [
    \Laravel\Fortify\Http\Controllers\AuthenticatedSessionController::class,
    'destroy',
])->name('logout-get');

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(
    function () {
        Route::get('/dashboard', [Dashboard::class, 'index'])->name('dashboard');
    }
);

Route::group(
    [
        'prefix' => '/',
        'middleware' => ['auth', 'use-app'],
    ],
    function () {
        require __DIR__ . '/eventTypes.php';
        require __DIR__ . '/sectors.php';
        require __DIR__ . '/routines.php';
        require __DIR__ . '/events.php';
        require __DIR__ . '/visitors.php';
        require __DIR__ . '/stuffs.php';
        require __DIR__ . '/cautions.php';
    }
);
