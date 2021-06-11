<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class laba extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function karyawan(){
        return $this->belongsTo(User::class, 'karyawan_id', 'id');
    }

    public function nasabah(){
        return $this->belongsTo(nasabah::class, 'nasabah_id', 'id');
    }
}
