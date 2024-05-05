<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Laravel\Sanctum\HasApiTokens as SanctumHasApiTokens;
use Laravel\Sanctum\PersonalAccessToken;

class user_credential extends Authenticatable
{

    use HasFactory, Notifiable, SanctumHasApiTokens;
    public $timestamps = false;

    protected $primaryKey = 'id_user_credentials';
    protected $table = "user_credentials";
    protected $fillable = [
        'id_customer',
        'id_karyawan',
        'email',
        'active',
        'verify_key',
        'password',
        'pass_key'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'id_customer', 'id_customer');
    }

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'id_karyawan', 'id_karyawan');
    }

    protected $casts = [
        'email_verified_at' => 'datetime',
        // 'password' => 'hashed',
    ];
}
