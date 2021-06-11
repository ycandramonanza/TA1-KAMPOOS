<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class nasabah extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'id';

    public function karyawan(){
        return $this->belongsTo(User::class, 'nasabah_id', 'id');
    }

    public function transaksi(){
        return $this->hasMany(transaksi::class, 'nasabah_id', 'id');
    }

    public function tabungan(){
        return $this->hasOne(tabungan::class, 'nasabah_id', 'id');
    }

    public function noTransaksi(){
        return $this->hasMany(noTransaksi::class, 'nasabah_id', 'id');
    }

    public function laba(){
        return $this->hasOne(laba::class, 'nasabah_id', 'id');
    }

}