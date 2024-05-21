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

        // Fetch addresses where jarak is 0
        $addresses = Address::where('jarak', 0)->with('customer')->get();

        // Fetch pending orders with related customer and addresses and details
        $orders = Transaksi::where('status', 'pending')
            ->with(['customer', 'customer.addresses', 'detail_transaksi.produk'])
            ->get();

        // Define the shipping rate (for example, 1000 per kilometer)
        $shipping_rate = 2000;

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

        // Update related orders
        $this->updateOrderTotalHarga($address);

        return redirect('/admin/address')->with('success', 'Address and order total updated successfully');
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

        // Update related orders
        $this->updateOrderTotalHarga($address);

        return redirect('/admin/address')->with('success', 'Address and order total updated successfully');
    }

    private function updateOrderTotalHarga(Address $address)
    {
        $shipping_rate = 1000; // Define your shipping rate here

        $orders = Transaksi::where('id_customer', $address->id_customer)->where('status', 'pending')->get();

        foreach ($orders as $order) {
            $shipping_cost = $address->jarak * $shipping_rate;
            $order->total_harga = $order->total_harga + $shipping_cost;
            $order->save();
        }
    }
}
