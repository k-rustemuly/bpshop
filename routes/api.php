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

Route::get('/category', [App\Http\Controllers\Api\CategoryController::class, 'list']);

Route::group(['prefix' => 'product', 'as' => 'product.'], function() {

    Route::get('', [App\Http\Controllers\Api\ProductController::class, 'list']);

    Route::get('/{slug}', [App\Http\Controllers\Api\ProductController::class, 'slug']);

});

Route::group(['prefix' => 'cart', 'as' => 'cart.'], function() {

    Route::post('/{uuid?}', [App\Http\Controllers\Api\CartController::class, 'save'])->whereUuid('uuid');

    Route::delete('/{uuid?}', [App\Http\Controllers\Api\CartController::class, 'delete'])->whereUuid('uuid');

    Route::get('/{uuid?}', [App\Http\Controllers\Api\CartController::class, 'list'])->whereUuid('uuid');

    Route::post('/checkout', [App\Http\Controllers\Api\CartController::class, 'checkout'])->middleware(['auth:sanctum']);

    Route::post('/{uuid}/checkout', [App\Http\Controllers\Api\CartController::class, 'checkoutGuest'])->whereUuid('uuid');

});

Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::get('/profile', function() {
        return auth()->user();
    });

    Route::post('/logout', [App\Http\Controllers\Api\AuthController::class, 'logout']);
});
