<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Referencia extends Model
{
    use HasFactory;

    public function producto(){
        return $this->belongsTo(Producto::class);
    }

    public function pedidos(){
        return $this->belongsToMany(Pedido::class,'linea_pedidos');
    }
}
