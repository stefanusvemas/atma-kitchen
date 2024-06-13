<?php

namespace App\Models;

use App\Models\Karyawan;
use App\Models\PenarikanSaldo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransferSaldo extends Model
{
    use HasFactory;

    protected $table = 'transfer_saldo';

    protected $primaryKey = 'id_transfer';
    public $timestamps = false;

    protected $fillable = [
        'id_penarikan',
        'id_karyawan',
        'tgl_transfer',
        'foto_bukti',
        'bank_asal',
    ];

    public function penarikanSaldo()
    {
        return $this->belongsTo(PenarikanSaldo::class, 'id_penarikan');
    }

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'id_karyawan');
    }
}
