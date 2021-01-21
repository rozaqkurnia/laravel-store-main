<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShoppingCartController;
use App\Http\Controllers\UserController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('products', [ProductController::class, 'index']);
Route::get('products/{id}', [ProductController::class, 'show']);
Route::post('products/{id}/like', [ProductController::class, 'like']);
Route::get('user', [UserController::class, 'random']);

Route::post('test', [ShoppingCartController::class, 'index']);
Route::post('products/{id}/plus', [ShoppingCartController::class, 'increment']);
Route::post('products/{id}/minus', [ShoppingCartController::class, 'decrement']);
Route::delete('user/{id}/cart/', [ShoppingCartController::class, 'destroy']);
//Route::post('products/{id}/addToCart', [ShoppingCartController::class, 'addToCart']);
//Route::post('products/{id}/removeFromCart', [ShoppingCartController::class, 'removeFromCart']);

