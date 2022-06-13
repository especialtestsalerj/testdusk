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

Route::group(
    [
        'prefix' => '/',
        'middleware' => ['auth'],
    ],
    function () {
        require __DIR__ . '/eventTypes.php';
        require __DIR__ . '/sectors.php';
    }
);
