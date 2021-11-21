<?php

use App\Http\Controllers\ProductController;

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::group(['middleware' => ['auth:sanctum']], function(){
    # Dashboard
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])
        ->name('dashboard');
    
    # Products
    Route::get('/product/{id}/edit', [ProductController::class, "edit"]);
    Route::get('/product/{id}/edit', [ProductController::class, "edit"]);
    Route::get('/products/search/{keyword}', [ProductController::class, "searchPage"]);
    Route::get('/product/new', function () {
        return view('products.form')->with([
            'type'      => 'create',
            'product'   => [],
            'nav_page'  => 'products',
        ]);
    });
    Route::get('/products', function(){
        return view('products.index');
    });
    
});
