<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Customer as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Customer extends Model
{
    use HasFactory, HasApiTokens, Notifiable;
    public $timestamps = false;

    protected $primaryKey = 'id_customer';
    protected $table = "customer";
    protected $fillable = [
        'nama',
        'tanggal_lahir',
        'jumlah_poin',
        'no_telp',
        'saldo'
    ];

    public function user_credential()
    {
        return $this->hasOne(user_credential::class, 'id_customer', 'id_customer');
    }

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'id_customer', 'id_customer');
    }
    public function addresses()
    {
        return $this->hasMany(Address::class, 'id_customer', 'id_customer');
    }  
}
