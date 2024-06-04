<?php

namespace App\Models;

use App\Models\TransferSaldo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenarikanSaldo extends Model
{
    use HasFactory;

    protected $table = 'penarikan_saldo';

    protected $primaryKey = 'id_penarikan';
    public $timestamps = false;

    protected $fillable = [
        'id_customer',
        'jumlah_penarikan',
        'no_rek',
        'bank',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'id_customer');
    }

    public function transfers()
    {
        return $this->hasMany(TransferSaldo::class, 'id_penarikan');
    }
}
