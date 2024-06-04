<?php

use App\Http\Controllers\admin\BahanBakuController as AdminBahanBakuController;
use App\Http\Controllers\admin\CustomerController as AdminCustomerController;
use App\Http\Controllers\admin\ProfileController as AdminProfileController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\HampersController;
use App\Http\Controllers\admin\HistoryPesananController;
use App\Http\Controllers\admin\ProdukController;
use App\Http\Controllers\admin\ResepController;
use App\Http\Controllers\Api\CustomerController as ApiCustomerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\manager\BahanBakuController as ManagerBahanBakuController;
use App\Http\Controllers\manager\DashboardController as ManagerDashboardController;
use App\Http\Controllers\manager\JabatanController;
use App\Http\Controllers\manager\KaryawanController;
use App\Http\Controllers\manager\PembelianBahanBakuController;
use App\Http\Controllers\manager\PenitipController;
use App\Http\Controllers\manager\PengeluaranLainController;
use App\Http\Controllers\manager\ProfileController as ManagerProfileController;
use App\Http\Controllers\user\EditProfileController as UserEditProfileController;
use App\Http\Controllers\user\HistoryController;
use App\Http\Controllers\user\ProfileController as UserProfileController;
use App\Http\Controllers\user\AddressController;
use App\Http\Controllers\admin\AddressDistanceController;
use App\Http\Controllers\admin\KonfirmasiPembayaranController;
use App\Http\Controllers\admin\ProcessedTransaction;

use App\Http\Controllers\owner\DashboardController as OwnerDashboardController;
use App\Http\Controllers\owner\KaryawanController as OwnerKaryawanController;
use App\Http\Controllers\owner\ProfileController as OwnerProfileController;
use App\Http\Controllers\user\CartController;
use App\Http\Controllers\user\CheckoutController;
use App\Http\Controllers\DetailProdukController;
use App\Http\Controllers\manager\TransaksiController;
use App\Http\Controllers\PdfController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/detail_product/{id}', [DetailProdukController::class, 'index']);



Route::get('/register', [CustomerController::class, 'register'])->name('register');
Route::post('registerAction', [CustomerController::class, 'registerAction'])->name('registerAction');
Route::get('/register/verify/{verify_key}', [CustomerController::class, 'verify'])->name('verify');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('loginAction', [LoginController::class, 'loginAction'])->name('loginAction');


Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', [DashboardController::class, 'index'])->name('admin');

    Route::get('/admin/address', [AddressDistanceController::class, 'index']);
    Route::post('/admin/address/input-distance/{id}', [AddressDistanceController::class, 'inputDistance']);
    Route::put('/admin/address/update-distance/{id}', [AddressDistanceController::class, 'updateDistance']);

    Route::get('/admin/proses-pesanan', [ProcessedTransaction::class, 'index']);
    Route::post('/admin/update-status/{id}', [ProcessedTransaction::class, 'updateStatus'])->name('admin.updateStatus');
    Route::post('/admin/finalize-status/{id}', [ProcessedTransaction::class, 'finalizeStatus'])->name('admin.finalizeStatus');

    Route::get('/admin/konfirmasi-pembayaran', [KonfirmasiPembayaranController::class, 'index']);
    Route::post('/admin/konfirmasi-pembayaran/confirm', [KonfirmasiPembayaranController::class, 'confirmPayment']);
    Route::get('/admin/konfirmasi-pembayaran/cancel/{id_transaksi}', [KonfirmasiPembayaranController::class, 'cancelOrder'])->name('cancel.order');

    Route::get('/admin/address', [AddressDistanceController::class, 'index']);

    Route::get('/logout', function () {
        Auth::logout();
        return redirect('/');
    });

    Route::get('/admin/profile', [AdminProfileController::class, 'index']);
    Route::post('/admin/profile/edit', [AdminProfileController::class, 'edit']);

    Route::get('/admin/hampers', [HampersController::class, 'index']);
    Route::get('/admin/hampers/add', [HampersController::class, 'create']);
    Route::post('/admin/hampers/add', [HampersController::class, 'createAction']);
    Route::get('/admin/hampers/edit/{id}', [HampersController::class, 'edit']);
    Route::post('/admin/hampers/edit/{id}', [HampersController::class, 'editAction']);
    Route::get('/admin/hampers/delete/{id}', [HampersController::class, 'destroy']);
    Route::get('/admin/hampers/search', [HampersController::class, 'search']);

    Route::get('/admin/customers', [AdminCustomerController::class, 'index']);
    Route::get('/admin/customers/search', [AdminCustomerController::class, 'search']);

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

    Route::get('/admin/produk/edit/{id}', [ProdukController::class, 'edit']);
    Route::post('/admin/produk/edit/{id}', [ProdukController::class, 'editAction']);

    Route::get('/admin/produk/titipan/add', [ProdukController::class, 'create_titipan']); //titipan
    Route::post('/admin/produk/titipan/add', [ProdukController::class, 'create_titipanAction']); //sendiri

    Route::get('/admin/produk/delete/{id}', [ProdukController::class, 'destroy']);
    Route::get('/admin/produk/search', [ProdukController::class, 'search']);

    Route::get('/admin/customers/history/{id}', [HistoryPesananController::class, 'index']);
    Route::get('/admin/customers/history/{id}/search', [HistoryPesananController::class, 'search']);
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

    Route::get('/manager/penitip', [PenitipController::class, 'index']);
    Route::get('/manager/penitip/search', [PenitipController::class, 'search']);
    Route::get('/manager/penitip/add', [PenitipController::class, 'add']);
    Route::post('/manager/penitip/add', [PenitipController::class, 'addAction']);
    Route::get('/manager/penitip/edit/{id}', [PenitipController::class, 'edit']);
    Route::post('/manager/penitip/edit/{id}', [PenitipController::class, 'editAction']);
    Route::get('/manager/penitip/delete/{id}', [PenitipController::class, 'delete']);

    Route::get('/manager/bahan_baku', [ManagerBahanBakuController::class, 'index']);
    Route::get('/manager/bahan_baku/search', [ManagerBahanBakuController::class, 'search']);

    Route::get('/manager/pembelian_bahan_baku', [PembelianBahanBakuController::class, 'index']);
    Route::get('/manager/pembelian_bahan_baku/search', [PembelianBahanBakuController::class, 'search']);
    Route::get('/manager/pembelian_bahan_baku/add', [PembelianBahanBakuController::class, 'add']);
    Route::post('/manager/pembelian_bahan_baku/add', [PembelianBahanBakuController::class, 'addAction']);
    Route::get('/manager/pembelian_bahan_baku/edit/{id}', [PembelianBahanBakuController::class, 'edit']);
    Route::post('/manager/pembelian_bahan_baku/edit/{id}', [PembelianBahanBakuController::class, 'editAction']);
    Route::get('/manager/pembelian_bahan_baku/delete/{id}', [PembelianBahanBakuController::class, 'delete']);

    Route::get('manager/list_pesanan', [TransaksiController::class, 'index']);


    Route::get('manager/pengeluaran_lain', [PengeluaranLainController::class, 'index']);
    Route::get('manager/pengeluaran_lain/search', [PengeluaranLainController::class, 'search']);
    Route::get('manager/pengeluaran_lain/add', [PengeluaranLainController::class, 'add']);
    Route::post('manager/pengeluaran_lain/add', [PengeluaranLainController::class, 'addAction']);
    Route::get('manager/pengeluaran_lain/edit/{id}', [PengeluaranLainController::class, 'edit']);
    Route::post('manager/pengeluaran_lain/edit/{id}', [PengeluaranLainController::class, 'editAction']);
    Route::get('manager/pengeluaran_lain/delete/{id}', [PengeluaranLainController::class, 'delete']);

    Route::get('/manager/profile', [ManagerProfileController::class, 'index']);
    Route::post('/manager/profile/edit', [ManagerProfileController::class, 'edit']);

    // Route::get('/resetPassword', [CustomerController::class, 'resetPassword']);
    Route::get('/listOrders', [TransaksiController::class, 'listOrdersToConfirm']);
    Route::get('orders/accept/{id}', [TransaksiController::class, 'acceptOrder']);
    Route::get('/orders/reject/{id}', [TransaksiController::class, 'rejectOrder']);


    Route::get('/laporanBahanBakuPerPeriode/{startDate}/{endDate}', [PdfController::class, 'laporanPenjualanBulanan']);
    Route::get('/laporan-penjualan-mo', [PdfController::class, 'laporanPenjualanBulanan']);
    Route::get('/laporan-bahanBaku-mo/{startDate}/{endDate}', [PdfController::class, 'laporanBahanBakuPerPeriode']);
});

Route::middleware(['auth', 'user'])->group(function () {
    Route::get('/user/profile', [UserProfileController::class, 'index']);
    Route::post('/user/profile', [UserProfileController::class, 'editAction']);

    Route::get('/user/profile/edit', [UserEditProfileController::class, 'index']);
    Route::post('/user/profile/edit', [UserEditProfileController::class, 'editAction']);

    Route::get('/user/orders_history', [HistoryController::class, 'index']);
    Route::get('/user/orders_history/search', [HistoryController::class, 'search']);
    Route::post('/user/orders_history/update_status/{id}', [HistoryController::class, 'updateStatus'])->name('user.updateStatus');

    Route::get('/cart', [CartController::class, 'index']);

    Route::get('/checkout', [CheckoutController::class, 'index']);
    Route::get('/user/address', [AddressController::class, 'index']);
    Route::get('/user/address/input', [AddressController::class, 'create']); // New route for input address
    Route::post('/user/address/input', [AddressController::class, 'store']);
    Route::get('/user/address/delete/{id}', [AddressController::class, 'delete']);
    Route::get('/user/address/edit/{id}', [AddressController::class, 'edit']);
    Route::post('/user/address/update/{id}', [AddressController::class, 'update']);
    Route::post('/checkout/pengiriman', [CheckoutController::class, 'pengirimanAction']);
    route::post('/checkout/poin', [CheckoutController::class, 'poinAction']);

    Route::get('/actionAddCart/{id}', [CartController::class, 'addAction']);
    Route::get('/addToCart/{id}', [CartController::class, 'addToCart']);
    route::get('/removeCart/{id}', [CartController::class, 'removeAction']);

    route::post('/cart/update/{id}', [CartController::class, 'updateAction']);
    route::post('/cart/updateTglAmbil', [CartController::class, 'updateTanggalAmbil']);

    route::get('/invoice/{id}', [PdfController::class, 'invoice']);
    route::get('/cetak-nota/{id}', [PdfController::class, 'invoiceByProduct']);

    // Route::get('user/complatedPurcase', [CheckoutController::class, 'complatedPurcase']);
    Route::post('/user/pembayaranAction', [CheckoutController::class, 'pembayaranAction']);
    Route::get('/user/pembayaran', [CheckoutController::class, 'pembayaran']);
});

Route::get('/logout', function () {
    Auth::logout();
    return redirect('/');
});


Route::middleware(['auth', 'owner'])->group(function () {
    Route::get('/owner', [OwnerDashboardController::class, 'index']);

    Route::get('/owner/karyawan', [OwnerKaryawanController::class, 'index']);
    Route::get('/owner/karyawan/search', [OwnerKaryawanController::class, 'search']);
    Route::get('/owner/karyawan/edit/{id}', [OwnerKaryawanController::class, 'edit']);
    Route::post('/owner/karyawan/edit/{id}', [OwnerKaryawanController::class, 'editAction']);

    Route::get('/owner/profile', [OwnerProfileController::class, 'index']);
    Route::post('/owner/profile/edit', [OwnerProfileController::class, 'edit']);


    Route::get('/laporan-penjualan', [PdfController::class, 'laporanPenjualanBulanan']);
    Route::get('/laporan-bahanBaku/{startDate}/{endDate}', [PdfController::class, 'laporanBahanBakuPerPeriode']);
});



Route::get('/forgot_password', [CustomerController::class, 'resetPassword']);
Route::post('/inputEmail', [CustomerController::class, 'resetPasswordAction']);
Route::get('/inputEmail/verifyResetPassword/{pass_key}', [CustomerController::class, 'verifyResetPassword'])->name('verifyResetPassword');
Route::post('/inputEmail/verifyResetPassword/{pass_key}', [CustomerController::class, 'verifyResetPasswordAction'])->name('verifyResetPasswordAction');
// route::get('/invoice', [PdfController::class, 'invoice']);
