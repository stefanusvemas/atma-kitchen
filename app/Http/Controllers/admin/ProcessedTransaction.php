<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProcessedTransaction extends Controller
{
    public function index()
    {
        $user_data = Karyawan::where('id_karyawan', Auth::user()->id_karyawan)->with('jabatan')->first();
        // Mengambil pesanan yang sedang diproses
        $processing_orders = Transaksi::where('status', 'processed')->get()->load('detail_transaksi', 'customer.addresses');
    
        // Mengambil pesanan yang sudah siap dipickup
        $ready_or_shipped_orders = Transaksi::where('status', 'siap dipickup')->get()->load('detail_transaksi', 'customer.addresses');
    
        return view('admin.proses_pesanan', compact('processing_orders', 'user_data', 'ready_or_shipped_orders'));
    }
    

    public function updateStatus(Request $request, $id)
    {
        $order = Transaksi::findOrFail($id);
        $order->status = $request->status;
        $order->save();

        return redirect()->back()->with('success', 'Order status updated successfully.');
    }

    public function finalizeStatus(Request $request, $id)
{
    $order = Transaksi::findOrFail($id);
    if ($request->status == 'selesai') {
        $order->status = 'selesai';
    } else {
        $order->status = $request->status;
    }
    $order->save();

    return redirect()->back()->with('success', 'Order status finalized successfully.');
}

}
