<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;

class DetailProdukController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $user_data = Customer::where('id_customer', Auth::user()->id_customer)->first();
            return view('product_detail', compact('user_data'));
        }
        return view('product_detail');
    }
}
