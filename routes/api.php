<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/sign-up', [App\Http\Controllers\Api\AuthController::class, 'signUp']);

Route::post('/sign-in', [App\Http\Controllers\Api\AuthController::class, 'signIn']);

Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::get('/profile', function(Request $request) {
        return auth()->user();
    });

    Route::post('/logout', [App\Http\Controllers\Api\AuthController::class, 'logout']);
});
