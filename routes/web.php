<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\File\UploadController;

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::post("/product/{id}/upload", [UploadController::class, "uploadFiles"]);
Route::group(['middleware' => ['auth:sanctum']], function(){
    # Dashboard
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])
        ->name('dashboard');
    
    # Products
    Route::get('/product/{id}/edit', [ProductController::class, "edit"]);

    Route::get('/products/search/{keyword}', [ProductController::class, "searchPage"]);
    Route::get('/products/filter/{category}', [ProductController::class, "filterPage"]);

    Route::get('/product/new', function () {
        return view('products.form')->with([
            'type'      => 'create',
            'product'   => [],
            'nav_page'  => 'product/new',
            'title'     => 'Create Product',
        ]);
    });
    Route::get('/products', [ProductController::class, "products"])->name('products');
    
    # Videos
    Route::get('/videos', [VideoController::class, "index"])->name('videos');
});
