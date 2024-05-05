<?php

namespace App\Http\Middleware;

use App\Models\Karyawan;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        $user_data = Karyawan::where('id_karyawan', Auth::user()->id_karyawan)->value('id_jabatan'); // Mengambil informasi pegawai terkait dari model User

        if (!$user_data) {
            abort(403, 'Unauthorized access');
        }

        // Memeriksa apakah jabatan pegawai adalah admin
        if ($user_data == 2) {
            return $next($request);
        }

        // Logika untuk menghandle error ketika jabatan tidak memenuhi
        abort(403, 'Unauthorized access');
    }
}
