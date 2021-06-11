<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class noTransaksi extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function nasabah(){
        return $this->belongsTo(nasabah::class, 'nasabah_id', 'id' );
    }

    public function karyawan(){
        return $this->belongsTo(User::class, 'karyawan_id', 'id' );
    }

    
}
