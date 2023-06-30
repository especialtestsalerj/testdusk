<?php

use App\Http\Controllers\Dashboard;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Visitors\VisitorsCard as VisitorsCard;

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

Route::get('/logout', [
    \Laravel\Fortify\Http\Controllers\AuthenticatedSessionController::class,
    'destroy',
])->name('logout-get');

Route::group(
    [
        'prefix' => '/',
        'middleware' => ['auth:sanctum', config('jetstream.auth_session'), 'verified', 'use-app'],
    ],
    function () {
        Route::get('/dashboard', [Dashboard::class, 'index'])->name('dashboard');
        Route::get('/', function () {
            return redirect('dashboard');
        });

        require __DIR__ . '/eventTypes.php';
        require __DIR__ . '/sectors.php';
        require __DIR__ . '/person-restrictions.php';
        require __DIR__ . '/routines.php';

        require __DIR__ . '/visitors.php';

        Route::group(['prefix' => '/routines/{routine_id}'], function () {
            require __DIR__ . '/events.php';

            require __DIR__ . '/stuffs.php';
            require __DIR__ . '/cautions.php';
        });
    }
);

Route::get('visitors/card/{uuid?}', VisitorsCard::class)->name('visitors.card');
