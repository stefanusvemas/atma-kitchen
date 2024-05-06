<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\DetailTransaksi;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    public function index()
    {
        $user_data = Customer::where('id_customer', Auth::user()->id_customer)->first()->load('user_credential');
        $orders = Transaksi::where('id_customer', Auth::user()->id_customer)->with('detail_transaksi', 'detail_transaksi.produk')->get()->sortByDesc('id_transaksi');
        // return $orders;

        return view('user.orders_history', compact('user_data', 'orders'));
    }

    public function search(Request $request)
    {
        $user_data = Customer::where('id_customer', Auth::user()->id_customer)->first()->load('user_credential');

        $orders = Transaksi::where('id_customer', Auth::user()->id_customer)
            ->whereHas('detail_transaksi.produk', function ($query) use ($request) {
                $query->where('nama', 'like', '%' . $request->search . '%');
            })
            ->with('detail_transaksi', 'detail_transaksi.produk')
            ->get()->sortByDesc('id_transaksi');

        return view('user.orders_history', compact('user_data', 'orders'));
    }
}
