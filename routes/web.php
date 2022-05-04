<?php

use illuminate\support\facades\route;

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

route::get('/', function () {
    return view('welcome');
});

route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
