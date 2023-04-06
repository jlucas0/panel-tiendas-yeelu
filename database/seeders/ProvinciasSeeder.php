<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProvinciasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('provincias')->insert([
            ["codigo"=>2,"nombre"=>"Albacete"],
            ["codigo"=>3,"nombre"=>"Alicante/Alacant"],
            ["codigo"=>4,"nombre"=>"Almería"],
            ["codigo"=>1,"nombre"=>"Araba/Álava"],
            ["codigo"=>33,"nombre"=>"Asturias"],
            ["codigo"=>5,"nombre"=>"Ávila"],
            ["codigo"=>6,"nombre"=>"Badajoz"],
            ["codigo"=>7,"nombre"=>"Balears, Illes"],
            ["codigo"=>8,"nombre"=>"Barcelona"],
            ["codigo"=>48,"nombre"=>"Bizkaia"],
            ["codigo"=>9,"nombre"=>"Burgos"],
            ["codigo"=>10,"nombre"=>"Cáceres"],
            ["codigo"=>11,"nombre"=>"Cádiz"],
            ["codigo"=>39,"nombre"=>"Cantabria"],
            ["codigo"=>12,"nombre"=>"Castellón/Castelló"],
            ["codigo"=>13,"nombre"=>"Ciudad Real"],
            ["codigo"=>14,"nombre"=>"Córdoba"],
            ["codigo"=>15,"nombre"=>"Coruña, A"],
            ["codigo"=>16,"nombre"=>"Cuenca"],
            ["codigo"=>20,"nombre"=>"Gipuzkoa"],
            ["codigo"=>17,"nombre"=>"Girona"],
            ["codigo"=>18,"nombre"=>"Granada"],
            ["codigo"=>19,"nombre"=>"Guadalajara"],
            ["codigo"=>21,"nombre"=>"Huelva"],
            ["codigo"=>22,"nombre"=>"Huesca"],
            ["codigo"=>23,"nombre"=>"Jaén"],
            ["codigo"=>24,"nombre"=>"León"],
            ["codigo"=>25,"nombre"=>"Lleida"],
            ["codigo"=>27,"nombre"=>"Lugo"],
            ["codigo"=>28,"nombre"=>"Madrid"],
            ["codigo"=>29,"nombre"=>"Málaga"],
            ["codigo"=>30,"nombre"=>"Murcia"],
            ["codigo"=>31,"nombre"=>"Navarra"],
            ["codigo"=>32,"nombre"=>"Ourense"],
            ["codigo"=>34,"nombre"=>"Palencia"],
            ["codigo"=>35,"nombre"=>"Palmas, Las"],
            ["codigo"=>36,"nombre"=>"Pontevedra"],
            ["codigo"=>26,"nombre"=>"Rioja, La"],
            ["codigo"=>37,"nombre"=>"Salamanca"],
            ["codigo"=>38,"nombre"=>"Santa Cruz de Tenerife"],
            ["codigo"=>40,"nombre"=>"Segovia"],
            ["codigo"=>41,"nombre"=>"Sevilla"],
            ["codigo"=>42,"nombre"=>"Soria"],
            ["codigo"=>43,"nombre"=>"Tarragona"],
            ["codigo"=>44,"nombre"=>"Teruel"],
            ["codigo"=>45,"nombre"=>"Toledo"],
            ["codigo"=>46,"nombre"=>"Valencia/València"],
            ["codigo"=>47,"nombre"=>"Valladolid"],
            ["codigo"=>49,"nombre"=>"Zamora"],
            ["codigo"=>50,"nombre"=>"Zaragoza"],
            ["codigo"=>51,"nombre"=>"Ceuta"],
            ["codigo"=>52,"nombre"=>"Melilla"]]
        );
    }
}
