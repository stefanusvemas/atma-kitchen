<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use App\Models\Produk;
use App\Models\DetailTransaksi;
use App\Models\Transaksi;

class DetailProdukController extends Controller
{
    public function index($id)
    {
        if (Auth::check()) {
            $user_data = Customer::where('id_customer', Auth::user()->id_customer)->first();
            $produk = Produk::where('id_produk', $id)->first();
            $produk_lain = Produk::all()->sortByDesc('id_produk')->except($id)->take(3);
            $transaksi = Transaksi::where('id_customer', Auth::user()->id_customer)->whereNull('id_pembayaran')->first();

            if ($transaksi == null) {
                $transaksi = 0;
            }
            $cart_count = DetailTransaksi::where('id_transaksi', $transaksi->id_transaksi)->sum('jumlah');
            return view('product_detail', compact('user_data', 'produk', 'produk_lain', 'cart_count'));
        }
        $produk = Produk::where('id_produk', $id)->first();
        $produk_lain = Produk::inRandomOrder()->where('id_produk', '!=', $id)->limit(3)->get();
        // return $products;
        return view('product_detail', compact('produk', 'produk_lain'));
    }
}
