<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Karyawan;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressDistanceController extends Controller
{
    public function index()
    {
        $user_data = Karyawan::where('id_karyawan', Auth::user()->id_karyawan)->with('jabatan')->first();

        $addresses = Address::where('jarak', 0)->with('customer')->get();

        $orders = Transaksi::where('status', 'pending')
            ->with(['customer', 'customer.addresses', 'detail_transaksi.produk'])
            ->get();

        $shipping_rate = 2000;

        foreach ($orders as $order) {
            $address = $order->customer->addresses->first();
            $shipping_cost = $address ? $address->jarak * $shipping_rate : 0;
            $order->calculated_shipping_cost = $shipping_cost;
            $order->calculated_total_price = $order->total_harga + $shipping_cost;
        }

        return view('admin.address_distance', compact('addresses', 'orders', 'user_data', 'shipping_rate'));
    }

    public function inputDistance(Request $request, $id)
    {
        $request->validate([
            'jarak' => 'required|numeric|min:0',
        ]);

        $address = Address::findOrFail($id);
        $address->update([
            'jarak' => $request->input('jarak'),
        ]);

        return redirect('/admin/address')->with('success', 'Address distance updated successfully');
    }

    public function updateDistance(Request $request, $id)
    {
        $request->validate([
            'jarak' => 'required|numeric|min:0',
        ]);

        $address = Address::findOrFail($id);
        $address->update([
            'jarak' => $request->input('jarak'),
        ]);

        return redirect('/admin/address')->with('success', 'Address distance updated successfully');
    }
}
