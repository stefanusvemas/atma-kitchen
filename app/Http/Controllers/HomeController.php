<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $user_data = Customer::where('id_customer', Auth::user()->id_customer)->first();
            if ($user_data) {
                $produk = Produk::all()->sortByDesc('id_produk');
                return view('home', compact('user_data', 'produk'));
            }
            return redirect('/logout');
        }

        $produk = Produk::all()->sortByDesc('id_produk');
        // return $produk;
        return view('home', compact('produk'));
    }
}
