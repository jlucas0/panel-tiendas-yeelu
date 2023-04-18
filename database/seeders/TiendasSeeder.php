<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TiendasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tiendas')->insert([
            "nombre"=>"Demo",
            "foto"=>"demo.png",
            "logo"=>"demo.png",
            "direccion"=>"Calle Mayor 3",
            "cp"=>28999,
            "latitud"=>1,
            "longitud"=>1,
            "provincia_id"=>28,
            "email"=>"tienda@tienda.es",
            "password"=>Hash::make("12345")
            ]
        );
    }
}
