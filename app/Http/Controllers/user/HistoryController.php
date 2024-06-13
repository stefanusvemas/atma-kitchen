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
        $orders = Transaksi::where('id_customer', Auth::user()->id_customer)
            ->with('detail_transaksi', 'detail_transaksi.produk')
            ->where('id_pembayaran', '!=', null)
            ->get()
            ->sortByDesc('id_transaksi');
    
        $transaksi = Transaksi::where('id_customer', Auth::user()->id_customer)->whereNull('id_pembayaran')->first();
    
        if ($transaksi == null) {
            $cart_count = 0;
        } else {
            $cart_count = DetailTransaksi::where('id_transaksi', $transaksi->id_transaksi)->sum('jumlah');
        }
    
        return view('user.orders_history', compact('user_data', 'orders', 'cart_count'));
    }    

    public function search(Request $request)
    {
        $user_data = Customer::where('id_customer', Auth::user()->id_customer)->first()->load('user_credential');

        $orders = Transaksi::where('id_customer', Auth::user()->id_customer)
            ->whereHas('detail_transaksi.produk', function ($query) use ($request) {
                $query->where('nama', 'like', '%' . $request->search . '%');
            })
            ->with('detail_transaksi', 'detail_transaksi.produk')
            ->get()
            ->sortByDesc('id_transaksi');

        return view('user.orders_history', compact('user_data', 'orders'));
    }

    public function updateStatus(Request $request, $id)
    {
        $order = Transaksi::findOrFail($id);
        $order->status = 'selesai';
        $order->save();

        return redirect()->back()->with('success', 'Order status updated successfully.');
    }
}
