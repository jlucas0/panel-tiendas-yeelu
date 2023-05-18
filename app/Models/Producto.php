<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    public function marca(){
        return $this->belongsTo(Marca::class);
    }

    public function categoria(){
        return $this->belongsTo(Categoria::class);
    }

    public function etiquetas(){
        return $this->belongsToMany(Etiqueta::class);
    }

    public function fotos(){
        return $this->hasMany(Foto::class);
    }
}
