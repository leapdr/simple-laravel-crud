<?php

use App\Http\Controllers\ProductController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('products.index');
});

Route::get('/products', function(){
    return view('products.index');
});

Route::get('/products/search/{keyword}', [ProductController::class, "searchPage"]);

Route::get('/product/new', function () {
    return view('products.form')->with([
        'type'      => 'create',
        'product'   => [],
        'nav_page'  => 'products',
    ]);
});

Route::get('/product/{id}/edit', [ProductController::class, "edit"]);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
