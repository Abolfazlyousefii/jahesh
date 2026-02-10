<?php

use App\Support\FakeProducts;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home', [
        'sections' => FakeProducts::sections(),
    ]);
})->name('home');

Route::get('/products/{id}', function (int $id) {
    $product = FakeProducts::find($id);

    abort_if(!$product, 404);

    return view('products.show', [
        'product' => $product,
    ]);
})->name('products.show');
