<?php

use App\Http\Controllers\admin\BahanBakuController as AdminBahanBakuController;
use App\Http\Controllers\admin\CustomerController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\HampersController;
use App\Http\Controllers\admin\ProdukController;
use App\Http\Controllers\admin\ResepController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');

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
        return redirect('/');
    });

    Route::get('/admin/hampers', [HampersController::class, 'index']);
    Route::get('/admin/hampers/add', [HampersController::class, 'create']);
    Route::get('/admin/hampers/delete/{id}', [HampersController::class, 'destroy']);
    Route::get('/admin/hampers/search', [HampersController::class, 'search']);

    Route::get('/admin/customers', [CustomerController::class, 'index']);
    Route::get('/admin/customers/search', [CustomerController::class, 'search']);

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
    Route::get('/admin/produk/search', [ProdukController::class, 'search']);



    Route::get('/admin/customers/history', function () {
        return view('admin/history_pesanan_customer');
    });
});

Route::get('/logout', function () {
    Auth::logout();
    return redirect('/');
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

Route::get('/verify', function () {
    return view('verify');
});
