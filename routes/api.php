<?php

use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\KaryawanController;
use App\Http\Controllers\Api\SessionController;
use App\Http\Controllers\Api\AbsensiController;
use App\Http\Controllers\manager\TransaksiController;
use App\Http\Controllers\user\TransaksiCustomerController;
use App\Http\Controllers\Api\ProdukController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('produk', [ProdukController::class, 'index']);


//Customer
Route::post('login', [SessionController::class, 'login']);    //->middleware('auth:sanctum ')

Route::post('customer/register', [CustomerController::class, 'register']);

Route::post('customer/forgetPassword', [SessionController::class, 'forgetPassword']);

Route::put('customer/verifyForgetPw/{pass_key}', [SessionController::class, 'verifyForgetPw']);

Route::post('karyawan/store', [KaryawanController::class, 'store']);

Route::get('customer/showSaldo/{id}', [CustomerController::class, 'showSaldo']);

Route::group(
    ['middleware' => 'auth:sanctum'],
    function () {
        //logout
        Route::post('logout', [SessionController::class, 'logout']);

        //customer
        // Route::get('customer', [CustomerController::class, 'index']); // tidak perlu untuk customer
        Route::get('/customer ', [CustomerController::class, 'show']);
        Route::put('customer/{id} ', [CustomerController::class, 'update']);
        Route::delete('customer/{id} ', [CustomerController::class, 'destroy']);

        //karyawan
        Route::get('karyawan', [KaryawanController::class, 'index']);

        Route::get('karyawan/{id}', [KaryawanController::class, 'show']);
        Route::put('karyawan/{id}', [KaryawanController::class, 'update']);
        Route::delete('karyawan/{id} ', [KaryawanController::class, 'destroy']);

        //Absensi
        Route::get('absensi', [AbsensiController::class, 'index']);
        Route::post('absensi/store', [AbsensiController::class, 'store']);

        //Transaksi
        Route::post('/customer/daftarPesanan', [TransaksiCustomerController::class, 'daftarPesanan']);

        //absensi
        // Route::get('/karyawan/absensi/', [KaryawanController::class, 'showAbsensi']);
    }

    
);

Route::middleware(['auth:sanctum', 'KL'])->group(function () {

    // Route::get('/allabsensi', [AbsensiController::class, 'showAbsensi']);
    Route::get('/absensi/{bulan}', [AbsensiController::class, 'sumAbsensi']);
});

Route::middleware(['auth:sanctum', 'owner'])->group(function () {
    Route::get('/allabsensi/{bulan}', [AbsensiController::class, 'showAbsensi']);
    // Route::get('/absensi/{bulan}', [AbsensiController::class, 'sumAbsensi']);

});
