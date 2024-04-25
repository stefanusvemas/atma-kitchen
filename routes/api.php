<?php

use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\KaryawanController;
use App\Http\Controllers\Api\SessionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//karyawan
Route::get('karyawan', [KaryawanController::class, 'index']);

//Customer
Route::post('login', [SessionController::class, 'login']);    //->middleware('auth:sanctum ')
Route::post('customer/register', [CustomerController::class, 'register']);

Route::group(
    ['middleware' => 'auth:sanctum'],
    function () {
        //customer
        Route::get('customer', [CustomerController::class, 'index']); // tidak perlu untuk customer
        Route::get('customer/{id} ', [CustomerController::class, 'show']);    
        Route::put('customer/{id} ', [CustomerController::class, 'update']);
        Route::delete('customer/{id} ', [CustomerController::class, 'destroy']);
        
    }
);
   
