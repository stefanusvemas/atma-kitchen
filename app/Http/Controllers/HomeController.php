<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $user_data = Customer::where('id_customer', Auth::user()->id_customer)->first();
            // return $user_data;
            return view('home', compact('user_data'));
        }
        return view('home');
    }
}
