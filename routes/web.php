<?php

use App\Http\Controllers\ProductController;
use App\Support\FakeProducts;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home', [
        'sections' => FakeProducts::sections(),
    ]);
})->name('home');

Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/archive', [ProductController::class, 'index'])->name('products.archive');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');
