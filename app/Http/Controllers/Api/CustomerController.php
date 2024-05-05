<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

use App\Http\Controllers\Controller;
use App\Mail\MailSend;
use App\Models\Customer;
use App\Models\user_credential;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        try {
            $customer = Customer::all();

            return response()->json([
                'data' => $customer,
                'status' => true,
                'message' => 'Berhasil ambil data'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
                'data' => []
            ], 400);
        }
    }

    public function register(Request $request)
    {
        $str = Str::random(100);
        $validatedData = $request->validate([ // validasi input
            'nama' => 'required',
            'tanggal_lahir' => 'required|date',
            'jumlah_poin' => 'required|integer',
            'no_telp' => 'required|numeric|digits_between:10,15',
            'email' => 'required|email|unique:user_credentials,email',
            'password' => 'required|string|min:6'
        ]);

        $customer = Customer::create($validatedData); // menyimpan data di tabel customer
        $atribut = [
            'id_customer' => $customer['id_customer'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'verify_key' => $str,
        ];

        $customer = user_credential::create($atribut); // membuat baru di tabel user_credential

        // kirim email
        $details = [
            'nama' => $request->nama,
            'website' => 'Atma Kitchen',
            'datetime' => date('Y-m-d H:i:s'),
            'url' => request()->getHttpHost() . '/register/verify/' . $str
        ];
        Mail::to($request->email)->send(new MailSend($details)); //new MailSend($details)

        return response()->json([
            'message' => 'Link Verifikasi telah dikirim ke email anda. silahkan cek email anda untuk mengaktifkan akun.'
        ]);

        return response([
            'message' => 'Register Success',
            'customer' => $customer,
        ], 200);
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        try {
            $customer = Customer::find($id);

            if (!$customer) {
                throw new \Exception('Customer tidak ditemukan');
            }
            return response()->json([
                'status' => true,
                'message' => 'Berhasil ambil data',
                'data' => $customer
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
                'data' => []
            ], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $customer = Customer::findOrFail($id);
        $validatedData = $request->validate([ // validasi input
            'nama' => 'required',
            'tanggal_lahir' => 'required|date',
            'jumlah_poin' => 'required|integer',
            'no_telp' => 'required|numeric|digits_between:10,15',
            'email' => 'required|email',
            'password' => 'required|string|min:6'
        ]);

        $customer->update($validatedData);
        $atribut = [
            'id_customer' => $customer['id_customer'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ];


        $user_credential = user_credential::where('id_customer', $id)->first();

        $user_credential->update($atribut);

        return response([
            'message' => 'Register Success',
            'customer' => $customer,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        try {
            $customer = Customer::find($id);
            if (!$customer) {
                throw new \Exception('Customer tidak ditemukan');
            }

            $customer->delete();

            return response()->json([
                'status' => true,
                'message' => 'Berhasil delete data',
                'data' => $customer
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
                'data' => []
            ], 400);
        }
    }

    //email verivy
    public function verify($verify_key)
    {
        $keyCheck = user_credential::select('verify_key')
            ->where('verify_key', $verify_key)
            ->exists();

        if ($keyCheck) {
            $user = user_credential::where('verify_key', $verify_key)
                ->update([
                    'active' => 1,
                    'email_verified_at' => date('Y-m-d H:i:s'),
                ]);

            return response()->json([
                'message' => 'Verifikasi Berhasil. Akun Anda sudah aktif'
            ]);
        } else {
            return response()->json([
                'message' => 'Keys Tidak Valid.'
            ], 404);
        }
    }
}
