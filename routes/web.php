<?php

use App\Http\Controllers\admin\BahanBakuController as AdminBahanBakuController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\ProdukController;
use App\Http\Controllers\admin\ResepController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\manager\DashboardController as ManagerDashboardController;
use App\Http\Controllers\manager\JabatanController;
use App\Http\Controllers\manager\KaryawanController;

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

Route::get('/register', [CustomerController::class, 'register'])->name('register');
Route::post('registerAction', [CustomerController::class, 'registerAction'])->name('registerAction');
Route::get('/register/verify/{verify_key}', [CustomerController::class, 'verify'])->name('verify');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('loginAction', [LoginController::class, 'loginAction'])->name('loginAction');


Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', [DashboardController::class, 'index'])->name('admin');

    Route::get('/logout', function () {
        Auth::logout();
        return redirect('/');
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

Route::middleware(['auth', 'MO'])->group(function () {
    Route::get('/manager', [ManagerDashboardController::class, 'index']);

    Route::get('/manager/jabatan', [JabatanController::class, 'index']);
    Route::get('/manager/jabatan/search', [JabatanController::class, 'search']);
    Route::get('/manager/jabatan/add', [JabatanController::class, 'add']);
    Route::post('/manager/jabatan/add', [JabatanController::class, 'addAction']);
    Route::get('/manager/jabatan/edit/{id}', [JabatanController::class, 'edit']);
    Route::post('/manager/jabatan/edit/{id}', [JabatanController::class, 'editAction']);
    Route::get('/manager/jabatan/delete/{id}', [JabatanController::class, 'delete']);

    Route::get('/manager/karyawan', [KaryawanController::class, 'index']);
    Route::get('/manager/karyawan/search', [KaryawanController::class, 'search']);
    Route::get('/manager/karyawan/add', [KaryawanController::class, 'add']);
    Route::post('/manager/karyawan/add', [KaryawanController::class, 'addAction']);
    Route::get('/manager/karyawan/edit/{id}', [KaryawanController::class, 'edit']);
    Route::post('/manager/karyawan/edit/{id}', [KaryawanController::class, 'editAction']);
    Route::get('/manager/karyawan/delete/{id}', [KaryawanController::class, 'delete']);

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





    Route::get('/manager/profile', function () {
        return view('manager/profile');
    });
});

Route::get('/logout', function () {
    Auth::logout();
    return redirect('/');
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
