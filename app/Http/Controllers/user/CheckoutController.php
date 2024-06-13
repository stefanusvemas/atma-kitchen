<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use App\Models\DetailTransaksi;
use App\Models\NotaPemesanan;
use App\Models\Pembayaran;
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

        if ($produk->isEmpty()) {
            session()->flash('error', 'Cart is empty');
            return redirect('/');
        }

        $alamat = Pengiriman::where('id_transaksi', $transaksi->id_transaksi)->first();

        if ($alamat != null) {
            $pengiriman = Pengiriman::where('id_transaksi', $transaksi->id_transaksi)->first()->load('alamat');
            $ongkir = $pengiriman['alamat']['jarak'] * 2000;
        } else {
            $ongkir = 0;
        }
        // return $user_data;

        $total_item_price = 0;
        foreach ($produk as $item) {
            $total_item_price += $item->jumlah * $item->produk->harga;
        }

        $taxes = 0.11 * $total_item_price;
        if ($transaksi->poin > 0) {
            $subtotal = $total_item_price + $taxes - $transaksi->poin;
        } else {
            $subtotal = $total_item_price + $taxes;
        }

        $subtotal += $ongkir;
        // return $transaksi;
        return view('checkout', compact('user_data', 'cart_count', 'produk', 'total_item_price', 'taxes', 'subtotal', 'ongkir', 'transaksi'));
    }

    public function poinAction(Request $request)
    {
        $transaksi = Transaksi::where('id_customer', Auth::user()->id_customer)->whereNull('id_pembayaran')->first();
        $user_data = Customer::where('id_customer', Auth::user()->id_customer)->first();

        if ($request->poin == 'true') {
            $poin = $user_data->jumlah_poin;
            $poin = $poin * 100;
            $transaksi->poin = $poin;
            $transaksi->save();
        } else {
            $transaksi->poin = null;
            $transaksi->save();
        }

        return redirect('checkout');
    }

    public function pembayaran()
    {
        $transaksi = Transaksi::where('id_customer', Auth::user()->id_customer)->whereNull('id_pembayaran')->first();

        if ($transaksi == null) {
            $transaksi = 0;
        }

        $alamat = Pengiriman::where('id_transaksi', $transaksi->id_transaksi)->first();

        if ($alamat == null) {
            $ongkir = 0;
        } else {
            $pengiriman = Pengiriman::where('id_transaksi', $transaksi->id_transaksi)->first()->load('alamat');
            $ongkir = $pengiriman['alamat']['jarak'] * 2000;
        }

        $user_data = Customer::where('id_customer', Auth::user()->id_customer)->first();
        $cart_count = DetailTransaksi::where('id_transaksi', $transaksi->id_transaksi)->sum('jumlah');
        $produk = DetailTransaksi::where('id_transaksi', $transaksi->id_transaksi)->get()->load('produk');


        $total_item_price = 0;
        foreach ($produk as $item) {
            $total_item_price += $item->jumlah * $item->produk->harga;
        }

        $taxes = 0.11 * $total_item_price;
        if ($transaksi->poin > 0) {
            $subtotal = $total_item_price + $taxes - $transaksi->poin;
        } else {
            $subtotal = $total_item_price + $taxes;
        }
        $subtotal += $ongkir;

        return view(
            'user.kirim_bukti_pembayaran',
            compact('user_data', 'cart_count', 'produk', 'total_item_price', 'taxes', 'subtotal', 'ongkir')
        );
    }


    public function pembayaranAction(Request $request)
    {
        $transaksi = Transaksi::where('id_customer', Auth::user()->id_customer)->whereNull('id_pembayaran')->first()->load('pembayaran');
        $user_data = Customer::where('id_customer', Auth::user()->id_customer)->first();
        // return $transaksi;
        $pembayaran = $transaksi->pembayaran;

        // if ($pembayaran == null) {
        //     $pembayaran = new Pembayaran();
        // }

        $produk = DetailTransaksi::where('id_transaksi', $transaksi->id_transaksi)->get()->load('produk');

        $total_item_price = 0;
        foreach ($produk as $item) {
            $total_item_price += $item->jumlah * $item->produk->harga;
        }

        $taxes = 0.11 * $total_item_price;
        if ($transaksi->poin > 0) {
            $subtotal = $total_item_price + $taxes - $transaksi->poin;
        } else {
            $subtotal = $total_item_price + $taxes;
        }

        if ($pembayaran == null) {
            $pembayaran = new Pembayaran();
            $transaksi->total_harga = $subtotal;
            $transaksi->status = 'pending';
            $pembayaran->jenis_pembayaran = 'Bank Transfer';
            $pembayaran->verifikasi_pembayaran = 0;
            $pembayaran->save();
            $transaksi->save();
            $transaksi->id_pembayaran = $pembayaran->id_pembayaran;
        } else {
            $transaksi->total_harga = $subtotal;
            $transaksi->status = 'pending';
            $pembayaran->jenis_pembayaran = 'Bank Transfer';
            $pembayaran->verifikasi_pembayaran = 0;
            $pembayaran->save();
            $transaksi->save();
            $transaksi->id_pembayaran = $pembayaran->id_pembayaran;
        }

        $request->validate([
            'foto_bukti' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time() . '.' . $request->foto_bukti->extension();

        $request->foto_bukti->move(public_path('images/bukti_pembayaran'), $imageName);

        $transaksi->foto_bukti = $imageName;
        $transaksi->tgl_transaksi = date('Y-m-d H:i:s');

        $transaksi->save();

        $user_data->jumlah_poin = $user_data->jumlah_poin - $transaksi->poin / 100;
        $user_data->save();



        return redirect('/');
    }
}
