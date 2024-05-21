<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransaksiCustomerController extends Controller
{
    //
    public function daftarPesanan()
    {
        $customerId = Customer::where('id_customer', Auth::user()->id_customer)->first()->load('user_credential');

        $pendingOrders = $customerId->transaksi->where('status', 'pending');

        return response()->json($pendingOrders);
    }

    // public function kirimGambar(Request $request)
    // {
    //     // Validate the request
    //     $request->validate([
    //         'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    //     ]);

    //     // Get the authenticated customer
    //     $customerId = Customer::where('id_customer', Auth::user()->id_customer)->first();

    //     // Check if the customer has any pending orders
    //     $pendingOrders = $customerId->transaksi->where('status', 'pending');
    //     if ($pendingOrders->isEmpty()) {
    //         return response()->json(['message' => 'No pending orders found'], 404);
    //     }

    //     // Upload the image
    //     if ($request->hasFile('gambar')) {
    //         $image = $request->file('gambar');
    //         $imageName = time() . '.' . $image->getClientOriginalExtension();
    //         $image->move(public_path('images'), $imageName);

    //         // Update the pending orders with the image path
    //         foreach ($pendingOrders as $order) {
    //             $order->gambar = $imageName;
    //             $order->save();
    //         }

    //         return response()->json(['message' => 'Image uploaded successfully'], 200);
    //     }

    //     return response()->json(['message' => 'Image not found'], 404);
    // }
}
