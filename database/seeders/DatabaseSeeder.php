<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $seeders = [ProvinciasSeeder::class,EtiquetasSeeder::class,CategoriasSeeder::class];
        if(config('app.env')!="production"){
            $seeders[] = TiendasSeeder::class;
        }
        $this->call($seeders);
    }
}
