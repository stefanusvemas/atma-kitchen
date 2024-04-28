<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/detail_product', function () {
    return view('product_detail');
});

Route::get('/cart', function () {
    return view('cart');
});

Route::get('/checkout', function () {
    return view('checkout');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/register', function () {
    return view('register');
});

Route::get('/admin', function () {
    return view('admin/dashboard');
});

Route::get('/admin/bahan_baku', function () {
    return view('admin/bahan_baku');
});

Route::get('/admin/resep', function () {
    return view('admin/resep');
});

Route::get('/admin/produk', function () {
    return view('admin/product');
});

Route::get('/admin/hampers', function () {
    return view('admin/hampers');
});

Route::get('/admin/customers', function () {
    return view('admin/customers');
});

Route::get('/admin/bahan_baku/add', function () {
    return view('admin/tambah_bahan_baku');
});

Route::get('/admin/bahan_baku/edit', function () {
    return view('admin/edit_bahan_baku');
});

Route::get('/admin/resep/add', function () {
    return view('admin/tambah_resep');
});

Route::get('/admin/resep/edit', function () {
    return view('admin/edit_resep');
});

Route::get('/admin/produk/add', function () {
    return view('admin/tambah_produk_sendiri');
});

Route::get('/admin/produk/titipan/add', function () {
    return view('admin/tambah_produk_titipan');
});

Route::get('/admin/customers/history', function () {
    return view('admin/history_pesanan_customer');
});
