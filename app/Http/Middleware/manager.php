<?php

namespace App\Http\Middleware;

use App\Models\Karyawan;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class manager
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

        $user_data = Karyawan::where('id_karyawan', Auth::user()->id_karyawan)->value('id_jabatan');

        if (!$user_data) {
            abort(403, 'Unauthorized access');
        }

        if ($user_data == 3) {
            return $next($request);
        }

        abort(403, 'Unauthorized access');
    }
}
