<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotaPemesanan extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'nota_pemesanan';

    protected $fillable = [
        'no_nota',
        'id_transaksi',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($notaPemesanan) {
            $tahun = date('y');
            $bulan = date('m');
            $noUrut = static::whereRaw("SUBSTRING(no_nota, 1, 2) = $tahun")
                ->whereRaw("SUBSTRING(no_nota, 4, 2) = $bulan")
                ->count() + 1;

            $noNota = sprintf('%02d.%02d.%03d', $tahun, $bulan, $noUrut);
            $notaPemesanan->no_nota = $noNota;
        });
    }

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'id_transaksi', 'id_transaksi');
    }
}
