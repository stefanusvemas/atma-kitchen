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

Route::get('/manager', function () {
    return view('manager/dashboard');
});

Route::get('/manager/jabatan', function () {
    return view('manager/jabatan');
});

Route::get('/manager/karyawan', function () {
    return view('manager/karyawan');
});

Route::get('/manager/karyawan/add', function () {
    return view('manager/tambah_karyawan');
});

Route::get('/manager/karyawan/edit', function () {
    return view('manager/edit_karyawan');
});

Route::get('/manager/penitip', function () {
    return view('manager/penitip');
});

Route::get('/manager/penitip/add', function () {
    return view('manager/tambah_penitip');
});

Route::get('/manager/penitip/edit', function () {
    return view('manager/edit_penitip');
});

Route::get('/manager/bahan_baku', function () {
    return view('manager/bahan_baku');
});

Route::get('/manager/bahan_baku/edit', function () {
    return view('manager/edit_bahan_baku');
});

Route::get('manager/pengeluaran_lain', function () {
    return view('manager/pengeluaran_lain');
});

Route::get('manager/pengeluaran_lain/add', function () {
    return view('manager/tambah_pengeluaran_lain');
});

Route::get('manager/pengeluaran_lain/edit', function () {
    return view('manager/edit_pengeluaran_lain');
});

Route::get('/manager/pembelian_bahan_baku', function () {
    return view('manager/pembelian_bahan_baku');
});

Route::get('/manager/pembelian_bahan_baku/add', function () {
    return view('manager/tambah_pembelian_bahan_baku');
});

Route::get('/manager/pembelian_bahan_baku/edit', function () {
    return view('manager/edit_pembelian_bahan_baku');
});

Route::get('/manager/jabatan/add', function () {
    return view('manager/tambah_jabatan');
});

Route::get('/manager/jabatan/edit', function () {
    return view('manager/edit_jabatan');
});

Route::get('/manager/profile', function () {
    return view('manager/profile');
});

Route::get('/owner', function () {
    return view('owner/dashboard');
});

Route::get('/owner/karyawan', function () {
    return view('owner/karyawan');
});

Route::get('/owner/karyawan/edit', function () {
    return view('owner/edit_karyawan');
});

Route::get('/owner/profile', function () {
    return view('owner/profile');
});

Route::get('/user/profile', function () {
    return view('user/profile');
});

Route::get('/user/profile/edit', function () {
    return view('user/edit_profile');
});

Route::get('/user/orders_history', function () {
    return view('user/orders_history');
});
