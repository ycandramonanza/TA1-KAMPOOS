<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    
    public function nasabah(){
        return $this->hasMany(nasabah::class, 'karyawan_id', 'id');
    }

    public function transaksi(){
        return $this->hasMany(transaksi::class, 'karyawan_id', 'id');
    }

    public function tabungan(){
        return $this->hasOne(tabungan::class, 'karyawan_id', 'id');
    }

    public function noTransaksi(){
        return $this->hasMany(noTransaksi::class, 'karyawan_id', 'id');
    }

    public function laba(){
        return $this->hasOne(laba::class, 'karyawan_id', 'id');
    }

    public function Piutang(){
        return $this->hasOne(laba::class, 'karyawan_id', 'id');
    }


}
