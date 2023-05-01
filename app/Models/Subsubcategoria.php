<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subsubcategoria extends Model
{
    use HasFactory;

    public function subcategoria(){
        return $this->belongsTo(Subcategoria::class);
    }
}
