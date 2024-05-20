<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Alamat;
use App\Models\Customer;
use App\Models\DetailTransaksi;
use App\Models\Pengiriman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaksi;

class CartController extends Controller
{
    public function index()
    {
        $user_data = Customer::where('id_customer', Auth::user()->id_customer)->first();

        $transaksi = Transaksi::where('id_customer', Auth::user()->id_customer)->whereNull('id_pembayaran')->first();

        $alamat = Alamat::where('id_customer', Auth::user()->id_customer)->get();
        $alamat_selected = Pengiriman::where('id_transaksi', $transaksi['id_transaksi'])->first()->load('alamat');
        // return $alamat_selected;

        $kuota = Transaksi::where('tgl_ambil', $transaksi['tgl_ambil'])->with('detail_transaksi')->get();

        $allDetails = $kuota->pluck('detail_transaksi')->flatten();

        $groupedByProduct = $allDetails->groupBy('id_produk')->map(function ($group) {
            $jumlah = $group->sum('jumlah');
            return $jumlah;
        });


        if ($transaksi == null) {
            $transaksi = Transaksi::create([
                'id_customer' => Auth::user()->id_customer,
            ]);
        }


        $produk = DetailTransaksi::where('id_transaksi', $transaksi->id_transaksi)->get()->load('produk');
        $cart_count = DetailTransaksi::where('id_transaksi', $transaksi->id_transaksi)->sum('jumlah');
        // return $produk;

        return view('cart', compact('user_data', 'transaksi', 'produk', 'cart_count', 'alamat', 'alamat_selected'));
    }

    public function addAction($id)
    {
        $transaksi = Transaksi::where('id_customer', Auth::user()->id_customer)->whereNull('id_pembayaran')->first();

        if ($transaksi == null) {
            $transaksi = Transaksi::create([
                'id_customer' => Auth::user()->id_customer,
            ]);
        }

        $produk = DetailTransaksi::where('id_transaksi', $transaksi->id_transaksi)->where('id_produk', $id)->first();

        if ($produk == null) {
            DetailTransaksi::create([
                'id_transaksi' => $transaksi->id_transaksi,
                'id_produk' => $id,
                'jumlah' => 1,
                'satuan' => 'pcs',
            ]);
        } else {
            $produk->jumlah += 1;
            $produk->save();
        }

        return redirect('/');
    }

    public function addToCart($id)
    {
        $transaksi = Transaksi::where('id_customer', Auth::user()->id_customer)->whereNull('id_pembayaran')->first();

        if ($transaksi == null) {
            $transaksi = Transaksi::create([
                'id_customer' => Auth::user()->id_customer,
            ]);
        }

        $produk = DetailTransaksi::where('id_transaksi', $transaksi->id_transaksi)->where('id_produk', $id)->first();

        if ($produk == null) {
            DetailTransaksi::create([
                'id_transaksi' => $transaksi->id_transaksi,
                'id_produk' => $id,
                'jumlah' => 1,
                'satuan' => 'pcs',
            ]);
        } else {
            $produk->jumlah += 1;
            $produk->save();
        }

        return redirect('/cart');
    }

    public function removeAction($id)
    {
        $transaksi = Transaksi::where('id_customer', Auth::user()->id_customer)->whereNull('id_pembayaran')->first();

        $produk = DetailTransaksi::where('id_transaksi', $transaksi->id_transaksi)->where('id_produk', $id)->first();

        if ($produk->jumlah == 1) {
            $produk->delete();
        } else {
            $produk->jumlah -= 1;
            $produk->save();
        }

        return redirect('/cart');
    }

    public function updateAction($id, Request $request)
    {
        $transaksi = Transaksi::where('id_customer', Auth::user()->id_customer)->whereNull('id_pembayaran')->first();

        if ($transaksi) {
            $produk = DetailTransaksi::where('id_transaksi', $transaksi->id_transaksi)->where('id_produk', $id)->first();

            if ($produk) {
                $produk->jumlah = $request->jumlah;
                $produk->save();
            }
        }

        return redirect('/cart');
    }

    public function updateTanggalAmbil(Request $request)
    {
        $transaksi = Transaksi::where('id_customer', Auth::user()->id_customer)->whereNull('id_pembayaran')->first();
        $pengiriman = Pengiriman::where('id_transaksi', $transaksi['id_transaksi'])->first();

        if ($pengiriman == null) {
            $pengiriman = Pengiriman::create([
                'id_transaksi' => $transaksi->id_transaksi,
                'id_customer' => Auth::user()->id_customer,
                'id_alamat' => $request->alamat,
            ]);
        } else {
            $pengiriman->id_alamat = $request->alamat;
            $pengiriman->save();
        }

        if ($transaksi) {
            $transaksi->tgl_ambil = $request->tanggal_ambil;
            $transaksi->save();
        }

        return redirect('/cart');
    }
}
