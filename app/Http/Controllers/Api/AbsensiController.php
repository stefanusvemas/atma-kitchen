<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\Karyawan;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AbsensiController extends Controller
{
    // public function showAbsensi($request)
    // {
    //     $karyawan = Karyawan::whereHas('jabatan', function ($query) {
    //         $query->where('nama', 'karyawan lapangan');
    //     })->get();

    //     // Ambil tahun saat ini
    //     $tahun = Carbon::now()->year;

    //     // Hitung jumlah hari dalam bulan yang diberikan
    //     $jumlahHari = Carbon::create($tahun, $request)->daysInMonth;

    //     $alpha = [];
    //     $jumlahHariTidakAlpha = [];
    //     foreach ($karyawan as $k) {
    //         $absensi = Absensi::where('id_karyawan', $k->id_karyawan)->count();
    //         $alpha[$k->nama] = $absensi;

    //         $absensiBulan = Absensi::where('id_karyawan', $k->id_karyawan)
    //             ->whereYear('tanggal', $tahun)
    //             ->whereMonth('tanggal', $request)
    //             ->pluck('tanggal')
    //             ->toArray();
    //         $jumlahHariTidakAlpha[$k->nama] = $jumlahHari - count($absensiBulan);
    //     }

    //     return response()->json([
    //         'Dafrtar karyawan' => $karyawan,
    //         'Jumlah alpha' => $alpha,
    //         'Jumlah tidak alpha' => $jumlahHariTidakAlpha
    //     ]);
    //     // return view('absensi', compact('absensi'));
    // }

    public function showAbsensi($bulan)
    {
        $karyawan = Karyawan::whereHas('jabatan', function ($query) {
            $query->where('nama', 'karyawan lapangan');
        })->get();

        $tahun = Carbon::now()->year;
        $jumlahHari = Carbon::create($tahun, $bulan)->daysInMonth;

        $data = [];
        foreach ($karyawan as $k) {
            $absensiBulan = Absensi::where('id_karyawan', $k->id_karyawan)
                ->whereYear('tanggal', $tahun)
                ->whereMonth('tanggal', $bulan)
                ->get();

            $jumlahBolos = $absensiBulan->count();
            $jumlahHadir = $jumlahHari - $jumlahBolos;

            $data[] = [
                'nama' => $k->nama,
                'jumlah_hadir' => $jumlahHadir,
                'jumlah_bolos' => $jumlahBolos,
                'honor_harian' => $k->gaji,
                'bonus_rajin' => ($jumlahHadir >= 26) ? 100000 : 0,
                'total' => $jumlahHadir * $k->gaji + (($jumlahHadir >= 26) ? 100000 : 0)
            ];
        }

        $pdf = Pdf::loadView('absensi_pdf', [
            'data' => $data,
            'bulan' => $bulan,
            'tahun' => $tahun,
            'tanggal_cetak' => Carbon::now()->format('d F Y'),
        ]);

        return $pdf->stream();
    }

    // public function sumAbsensi($request)
    // {
    //     $user_data = Karyawan::where('id_karyawan', Auth::user()->id_karyawan)->first();

    //     // Validasi input bulan
    //     if ($request < 1 || $request > 12) {
    //         return response()->json(['message' => 'Bulan tidak valid'], 400);
    //     }

    //     // Ambil tahun saat ini
    //     $tahun = Carbon::now()->year;

    //     // Hitung jumlah hari dalam bulan yang diberikan
    //     $jumlahHari = Carbon::create($tahun, $request)->daysInMonth;

    //     // Ambil semua tanggal dalam bulan yang diberikan
    //     $tanggalBulan = collect(range(1, $jumlahHari))->map(function ($day) use ($tahun, $request) {
    //         return Carbon::create($tahun, $request, $day)->toDateString();
    //     });



    //     // Ambil semua tanggal absensi untuk karyawan pada bulan tersebut
    //     $absensi = Absensi::where('id_karyawan', $user_data->id_karyawan)
    //         ->whereYear('tanggal', $tahun)
    //         ->whereMonth('tanggal', $request)
    //         ->pluck('tanggal')
    //         ->toArray();

    //     // return response()->json(['jumlah_alpha' => $absensi]);

    //     // Hitung jumlah hari alpha
    //     $jumlahAlpha = $tanggalBulan->diff(collect($absensi))->count();

    //     return response()->json(['jumlah kehadiran' => $jumlahAlpha]);
    // }
}
