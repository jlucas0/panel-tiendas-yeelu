<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    public function lineaPedido(){
        return $this->hasMany(LineaPedido::class);
    }

    public function incidencias(){
        return $this->hasMany(Incidencia::class);
    }
}
