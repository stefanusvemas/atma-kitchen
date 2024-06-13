<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Karyawan;
use App\Models\Pembayaran;
use App\Models\Penitip;
use App\Models\Transaksi;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AbsensiController extends Controller
{
    //
    public function showAbsensi(Request $request)
    {
        $bulan = $request->month;
        $karyawan = Karyawan::whereHas('jabatan', function ($query) {
            $query->where('nama', 'karyawan lapangan');
        })->get();

        $tahun = Carbon::now()->year;
        $jumlahHari = Carbon::create($tahun, $bulan)->daysInMonth;

        $data = [];
        $totalBiaya = 0; // Initialize total biaya variable

        foreach ($karyawan as $k) {
            $absensiBulan = Absensi::where('id_karyawan', $k->id_karyawan)
                ->whereYear('tanggal', $tahun)
                ->whereMonth('tanggal', $bulan)
                ->get();

            $jumlahBolos = $absensiBulan->count();
            $jumlahHadir = $jumlahHari - $jumlahBolos;

            $total = $jumlahHadir * $k->gaji + (($jumlahHadir >= 26) ? 100000 : 0);

            $data[] = [
                'nama' => $k->nama,
                'jumlah_hadir' => $jumlahHadir,
                'jumlah_bolos' => $jumlahBolos,
                'honor_harian' => $k->gaji,
                'bonus_rajin' => ($jumlahHadir >= 26) ? 100000 : 0,
                'total' => $total
            ];

            $totalBiaya += $total; // Add total to total biaya
        }

        $pdf = Pdf::loadView('pdf.absensi', [
            'data' => $data,
            'bulan' => $bulan,
            'tahun' => $tahun,
            'tanggal_cetak' => Carbon::now()->format('d F Y'),
            'total_biaya' => $totalBiaya // Pass total biaya to the view
        ]);

        return $pdf->stream();
    }

    // public function generateReport()
    // {
    //     // $bulan = $request->month;
    //     $karyawan = Karyawan::whereHas('jabatan', function ($query) {
    //         $query->where('nama', 'karyawan lapangan');
    //     })->get();

    //     $tahun = Carbon::now()->year;

    //     //pemasukan 
    //     $totalPembayaran = Pembayaran::where('verifikasi_pembayaran', 1)->sum('jumlah_pembayaran');
    //     return $totalPembayaran;
    //     //pengeluaran 
    //     $totalGaji = 0; // Initialize total gaji variable
    //     foreach ($karyawan as $k) {
    //         $totalGaji += $k->gaji;
    //     }

    //     // Generate pemasukan report
    //     $pemasukanData = []; // Initialize pemasukan data array
    //     // Logic to fetch pemasukan data and populate $pemasukanData array

    //     // Generate pengeluaran report
    //     $pengeluaranData = []; // Initialize pengeluaran data array
    //     // Logic to fetch pengeluaran data and populate $pengeluaranData array

    //     $pdf = Pdf::loadView('pdf.pemasukanPengeluaran', [
    //         'pemasukanData' => $pemasukanData,
    //         'pengeluaranData' => $pengeluaranData,
    //         // 'bulan' => $bulan,
    //         'tahun' => $tahun,
    //         'totalGaji' => $totalGaji, // Pass total gaji to the view
    //         'tanggal_cetak' => Carbon::now()->format('d F Y')
    //     ]);
    //     return $pdf->stream();
    // }

    public function rekapPenitip()
    {
        // Ambil data penitip dan produk titipannya yang sudah terjual
        $penitips = Penitip::with('produk')->get();

        // Memuat view PDF dengan data yang telah disiapkan
        $pdf = PDF::loadView('pdf.rekapPenitip', [
            'penitips' => $penitips,
            'bulan' => Carbon::now()->format('F'), // Nama bulan
            'tahun' => Carbon::now()->year, // Tahun
            'tanggalCetak' => Carbon::now()->format('d F Y') // Tanggal cetak hari ini
        ]);

        // Mengembalikan PDF sebagai respons HTTP
        return $pdf->stream();
    }

    public function index()
    {
        $user_data = Karyawan::where('id_karyawan', Auth::user()->id_karyawan)->with('jabatan')->first();
        $karyawan = Karyawan::whereHas('jabatan', function ($query) {
            $query->where('id_jabatan', '<>', 1);
        })->with('jabatan')->get();

        // return $karyawan;
        return view('owner.absensi', compact('user_data', 'karyawan'));
    }
}
