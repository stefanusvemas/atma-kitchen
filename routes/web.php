<?php

use App\Http\Controllers\admin\BahanBakuController as AdminBahanBakuController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\ProdukController;
use App\Http\Controllers\admin\ResepController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Auth;

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

Route::get('/register', function () {
    return view('register');
});


Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('loginAction', [LoginController::class, 'loginAction'])->name('loginAction');



Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', [DashboardController::class, 'index'])->name('admin');

    Route::get('/logout', function () {
        Auth::logout();
        return redirect('login');
    });

    Route::get('/admin/bahan_baku', [AdminBahanBakuController::class, 'index']);

    Route::get('/admin/resep', [ResepController::class, 'index']);

    Route::get('/admin/produk', [ProdukController::class, 'index']);
    Route::get('/admin/produk/delete/{id}', [ProdukController::class, 'destroy']);

    Route::get('/admin/hampers', function () {
        return view('admin/hampers');
    });

    Route::get('/admin/customers', function () {
        return view('admin/customers');
    });

    Route::get('/admin/bahan_baku/add', [AdminBahanBakuController::class, 'create']);
    Route::post('/admin/bahan_baku/add', [AdminBahanBakuController::class, 'createAction']);
    Route::get('/admin/bahan_baku/search', [AdminBahanBakuController::class, 'search']);
    Route::get('/admin/bahan_baku/edit/{id}', [AdminBahanBakuController::class, 'edit']);
    Route::post('/admin/bahan_baku/edit/{id}', [AdminBahanBakuController::class, 'editAction']);
    Route::get('/admin/bahan_baku/delete/{id}', [AdminBahanBakuController::class, 'destroy']);

    Route::get('/admin/resep/add', function () {
        return view('admin/tambah_resep');
    });

    Route::get('/admin/resep/edit/{id}', [ResepController::class, 'edit']);

    Route::get('/admin/produk/add', [ProdukController::class, 'create_sendiri']);
    Route::post('/admin/produk/add', [ProdukController::class, 'create_sendiriAction']);

    Route::get('/admin/produk/titipan/add', function () {
        return view('admin/tambah_produk_titipan');
    });

    Route::get('/admin/customers/history', function () {
        return view('admin/history_pesanan_customer');
    });
});

Route::get('/logout', function () {
    Auth::logout();
    return redirect('login');
});
