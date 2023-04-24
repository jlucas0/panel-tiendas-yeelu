<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User;

class Tienda extends User
{
    use HasFactory;
    protected $casts = [
        'bloqueo_acceso' => 'datetime'
    ];

    public function provincia(){
        return $this->belongsTo(Provincia::class,'provincia_id','codigo');
    }
}
