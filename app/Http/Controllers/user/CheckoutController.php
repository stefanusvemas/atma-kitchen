<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use App\Models\DetailTransaksi;
use App\Models\Pengiriman;
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
        $produk = DetailTransaksi::where('id_transaksi', $transaksi->id_transaksi)->get()->load('produk');

        $total_item_price = 0;
        foreach ($produk as $item) {
            $total_item_price += $item->jumlah * $item->produk->harga;
        }

        $taxes = 0.11 * $total_item_price;

        $subtotal = $total_item_price + $taxes;

        return view('checkout', compact('user_data', 'cart_count', 'produk', 'total_item_price', 'taxes', 'subtotal'));
    }

    public function pengirimanAction(Request $request)
    {
        $transaksi = Transaksi::where('id_customer', Auth::user()->id_customer)->whereNull('id_pembayaran')->first();
        $pengiriman = Pengiriman::where('id_transaksi', $transaksi['id_transaksi'])->first()->load('alamat');
        $pengiriman->update([
            'jenis' => $request->jenis,
            'status_pengiriman' => null
        ]);

        return redirect('user/pembayaran');
    }

    public function pembayaran()
    {
        $transaksi = Transaksi::where('id_customer', Auth::user()->id_customer)->whereNull('id_pembayaran')->first();

        if ($transaksi == null) {
            $transaksi = 0;
        }

        $user_data = Customer::where('id_customer', Auth::user()->id_customer)->first();
        $cart_count = DetailTransaksi::where('id_transaksi', $transaksi->id_transaksi)->sum('jumlah');
        $produk = DetailTransaksi::where('id_transaksi', $transaksi->id_transaksi)->get()->load('produk');

        $total_item_price = 0;
        foreach ($produk as $item) {
            $total_item_price += $item->jumlah * $item->produk->harga;
        }

        $taxes = 0.11 * $total_item_price;

        $subtotal = $total_item_price + $taxes;

        return view(
            'user.kirim_bukti_pembayaran',
            compact('user_data', 'cart_count', 'produk', 'total_item_price', 'taxes', 'subtotal')
        );
    }


    public function pembayaranAction(Request $request)
    {
        $transaksi = Transaksi::where('id_customer', Auth::user()->id_customer)->whereNull('id_pembayaran')->first();
        return $transaksi;
        return redirect('user/kirim_bukti_pembayaran');
    }
}
