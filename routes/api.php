<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Visitor as VisitorApi;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('visitors/open', [VisitorApi::class, 'openVisitors'])
    ->middleware([
        'auth:sanctum',
        'canInCurrentBuilding:visitors:search,cautions:store,cautions:update',
    ])
    ->name('visitors.open');
