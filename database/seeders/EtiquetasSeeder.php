<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EtiquetasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('grupo_etiquetas')->insert([
            ["nombre"=>"Ingredientes"],
            ["nombre"=>"Dietas"],
            ["nombre"=>"Valores"],
        ]
        );
        DB::table('etiquetas')->insert([
            ["nombre"=>"Bajo en sal","grupo_etiqueta_id"=>1],
            ["nombre"=>"Bajo en azúcar","grupo_etiqueta_id"=>1],
            ["nombre"=>"Sin azúcares añadidos","grupo_etiqueta_id"=>1],
            ["nombre"=>"Bajo en grasas saturadas","grupo_etiqueta_id"=>1],
            ["nombre"=>"Alto en fibras","grupo_etiqueta_id"=>1],
            ["nombre"=>"Alto en proteínas","grupo_etiqueta_id"=>1],
            ["nombre"=>"Sin levadura","grupo_etiqueta_id"=>1],
            ["nombre"=>"Contiene probióticos","grupo_etiqueta_id"=>1],
            ["nombre"=>"Alto en omega 3","grupo_etiqueta_id"=>1],
            ["nombre"=>"Sin nueces","grupo_etiqueta_id"=>1],
            ["nombre"=>"Sin aditivos","grupo_etiqueta_id"=>1],
            ["nombre"=>"Sin conservantes","grupo_etiqueta_id"=>1],
            ["nombre"=>"Sin soja","grupo_etiqueta_id"=>1],
            ["nombre"=>"Sin gluten","grupo_etiqueta_id"=>2],
            ["nombre"=>"Sin lactosa","grupo_etiqueta_id"=>2],
            ["nombre"=>"Vegano","grupo_etiqueta_id"=>2],
            ["nombre"=>"Vegetariano","grupo_etiqueta_id"=>2],
            ["nombre"=>"Ecológico","grupo_etiqueta_id"=>2],
            ["nombre"=>"Bajo en FODMAP","grupo_etiqueta_id"=>2],
            ["nombre"=>"Paleo","grupo_etiqueta_id"=>2],
            ["nombre"=>"Keto","grupo_etiqueta_id"=>2],
            ["nombre"=>"Crudo","grupo_etiqueta_id"=>2],
            ["nombre"=>"IG Bajo","grupo_etiqueta_id"=>2],
            ["nombre"=>"Envase biodegradable","grupo_etiqueta_id"=>3],
            ["nombre"=>"Sin crueldad animal","grupo_etiqueta_id"=>3],
            ["nombre"=>"Negocio familiar","grupo_etiqueta_id"=>3],
            ["nombre"=>"Apoya acciones sociales","grupo_etiqueta_id"=>3],
            ["nombre"=>"Pesca sostenible","grupo_etiqueta_id"=>3],
            ["nombre"=>"Sin plástico","grupo_etiqueta_id"=>3],
            ["nombre"=>"Fundado por miembro LGBTQIA","grupo_etiqueta_id"=>3],
            ["nombre"=>"Fundado por una mujer","grupo_etiqueta_id"=>3],
            ["nombre"=>"Comercio justo","grupo_etiqueta_id"=>3],
            ["nombre"=>"CO2 Neutro","grupo_etiqueta_id"=>3],
            ["nombre"=>"Empresa española","grupo_etiqueta_id"=>3],
        ]
        );
    }
}
