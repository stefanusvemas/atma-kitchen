<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Karyawan;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Auth;

class HistoryPesananController extends Controller
{
    public function index($id)
    {
        $user_data = Karyawan::where('id_karyawan', Auth::user()->id_karyawan)->with('jabatan')->first();
        $orders = Transaksi::where('id_customer', $id)->with('detail_transaksi', 'detail_transaksi.produk')->get()->sortByDesc('id_transaksi');

        // return $orders;
        return view('admin.history_pesanan_customer', compact('user_data', 'orders', 'id'));
    }

    public function search(Request $request, $id)
    {
        $user_data = Karyawan::where('id_karyawan', Auth::user()->id_karyawan)->with('jabatan')->first();

        $orders = Transaksi::where('id_customer', $id)
            ->whereHas('detail_transaksi.produk', function ($query) use ($request) {
                $query->where('nama', 'like', '%' . $request->search . '%');
            })
            ->with('detail_transaksi', 'detail_transaksi.produk')
            ->get()->sortByDesc('id_transaksi');

        // return $orders;

        return view('admin.history_pesanan_customer', compact('user_data', 'orders', 'id'));
    }
}
