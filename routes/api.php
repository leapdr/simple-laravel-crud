<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Product;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Auth\CustomAuthController;

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

/**
 * Exposed Routes
 * */

# GET products
Route::get('/products', [ProductController::class, 'index']);

# GET product using id
Route::get('/product/{id}', [ProductController::class, 'show']);

# GET product search
Route::get('/products/search/{name}', [ProductController::class, 'search']);

# POST user register
Route::post('/register', [CustomAuthController::class, 'register']);

# POST user login
Route::post('/login', [CustomAuthController::class, 'login']);

/**
 * Protected Routes
 * */
Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::post('/products', [ProductController::class, 'store']);
    Route::put('/product/{id}', [ProductController::class, 'update']);
    Route::delete('/product/{id}', [ProductController::class, 'destroy']);

    Route::post('/logout', [CustomAuthController::class, 'logout']);
});

