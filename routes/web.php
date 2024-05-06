<?php

use App\Http\Controllers\admin\BahanBakuController as AdminBahanBakuController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\HampersController;
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

    Route::get('/admin/hampers', [HampersController::class, 'index']);
    Route::get('/admin/hampers/add', [HampersController::class, 'create']);
    Route::get('/admin/hampers/delete/{id}', [HampersController::class, 'destroy']);
    Route::get('/admin/hampers/search', [HampersController::class, 'search']);

    Route::get('/admin/customers', function () {
        return view('admin/customers');
    });

    Route::get('/admin/bahan_baku', [AdminBahanBakuController::class, 'index']);
    Route::get('/admin/bahan_baku/add', [AdminBahanBakuController::class, 'create']);
    Route::post('/admin/bahan_baku/add', [AdminBahanBakuController::class, 'createAction']);
    Route::get('/admin/bahan_baku/search', [AdminBahanBakuController::class, 'search']);
    Route::get('/admin/bahan_baku/edit/{id}', [AdminBahanBakuController::class, 'edit']);
    Route::post('/admin/bahan_baku/edit/{id}', [AdminBahanBakuController::class, 'editAction']);
    Route::get('/admin/bahan_baku/delete/{id}', [AdminBahanBakuController::class, 'destroy']);

    Route::get('/admin/resep', [ResepController::class, 'index']);
    Route::get('/admin/resep/add', [ResepController::class, 'create']);
    Route::post('/admin/resep/add', [ResepController::class, 'createAction']);
    Route::get('/admin/resep/edit/{id}', [ResepController::class, 'edit']);
    Route::post('/admin/resep/edit/{id}', [ResepController::class, 'editAction']);
    Route::get('/admin/resep/delete/{id}', [ResepController::class, 'destroy']);
    Route::get('/admin/resep/search', [ResepController::class, 'search']);

    Route::get('/admin/produk', [ProdukController::class, 'index']);
    Route::get('/admin/produk/add', [ProdukController::class, 'create_sendiri']); //sendiri
    Route::post('/admin/produk/add', [ProdukController::class, 'create_sendiriAction']); //sendiri

    Route::get('/admin/produk/titipan/add', [ProdukController::class, 'create_titipan']); //titipan
    Route::post('/admin/produk/titipan/add', [ProdukController::class, 'create_titipanAction']); //sendiri

    Route::get('/admin/produk/delete/{id}', [ProdukController::class, 'destroy']);
    Route::get('/admin/resep/search', [ProdukController::class, 'search']);



    Route::get('/admin/customers/history', function () {
        return view('admin/history_pesanan_customer');
    });
});

Route::get('/logout', function () {
    Auth::logout();
    return redirect('login');
});
