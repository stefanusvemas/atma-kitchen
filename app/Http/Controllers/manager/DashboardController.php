<?php

namespace App\Http\Controllers\manager;

use App\Http\Controllers\Controller;
use App\Models\DetailTransaksi;
use App\Models\Karyawan;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $user_data = Karyawan::where('id_karyawan', Auth::user()->id_karyawan)->with('jabatan')->first();
        $today_order = Transaksi::whereDate('tgl_transaksi', date('Y-m-d'))->count();
        $today_income = number_format(Transaksi::whereDate('tgl_transaksi', date('Y-m-d'))->sum('total_harga'), 2, ",", ".");
        $recent_transaction = DetailTransaksi::with(['transaksi.customer', 'produk'])->orderBy('id_detail_transaksi', 'desc')->take(5)->get()->groupBy('id_transaksi');
        // return $recent_transaction;
        return view('manager.dashboard', compact('today_order', 'today_income', 'recent_transaction', 'user_data'));
    }
}
