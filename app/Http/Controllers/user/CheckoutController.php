<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use App\Models\DetailTransaksi;
use App\Models\Transaksi;

class CheckoutController extends Controller
{
    public function index()
    {
        $transaksi = Transaksi::where('id_customer', Auth::user()->id_customer)->whereNull('id_pembayaran')->first();

        if ($transaksi == null) {
            $transaksi = 0;
        }

        $user_data = Customer::where('id_customer', Auth::user()->id_customer)->first();
        $cart_count = DetailTransaksi::where('id_transaksi', $transaksi->id_transaksi)->sum('jumlah');
        return view('checkout', compact('user_data', 'cart_count'));
    }
}
