<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Product;

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

# POST create product
Route::post('/products', function(){
    return Product::create([
        'name'          => 'Product One',
        'category'      => 'Category 1',
        'description'   => 'This is Product One Description',
    ]);
});

# GET product by id
Route::get('/products', function(){
    return Product::all();
});
