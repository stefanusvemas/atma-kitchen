<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/detail_product', function () {
    return view('product_detail');
});
