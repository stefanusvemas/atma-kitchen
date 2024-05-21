<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $user_data = Customer::where('id_customer', Auth::user()->id_customer)->first();
            if ($user_data) {
                $produk = Produk::all()->sortByDesc('id_produk');

                $transaksi = Transaksi::where('id_customer', Auth::user()->id_customer)->whereNull('id_pembayaran')->first();

                if ($transaksi == null) {
                    $cart_count = 0;
                } else {
                    $cart_count = DetailTransaksi::where('id_transaksi', $transaksi->id_transaksi)->sum('jumlah');
                }

                // return $cart_count;

                return view('home', compact('user_data', 'produk', 'cart_count'));
            }
            return redirect('/logout');
        }

        $produk = Produk::all()->sortByDesc('id_produk');
        // return $produk;
        return view('home', compact('produk'));
    }
}
