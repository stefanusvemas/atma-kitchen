<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    //
    public function index()
    {
        $user_data = Karyawan::where('id_karyawan', Auth::user()->id_karyawan)->with('jabatan')->first();
        $customer = Customer::with(['user_credential'])->get();
        // return ($customer);
        return view('admin.customers', compact('user_data', 'customer'));
    }

    public function search(Request $request)
    {
        $search = $request->query('search');
        $user_data = Karyawan::where('id_karyawan', Auth::user()->id_karyawan)->with('jabatan')->first();
        $customer = Customer::where('nama', 'like', "%$search%")->get();
        // return ($search);
        return view('admin.customers', compact('user_data', 'customer'));
    }
}
