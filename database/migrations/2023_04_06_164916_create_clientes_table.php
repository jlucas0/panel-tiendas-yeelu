<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('clientes');
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('password');
            $table->string("nombre",100)->nullable();
            $table->string("apellidos",200)->nullable();
            $table->date("fecha_nacimiento")->nullable();
            $table->enum("genero",["m","h","x"])->nullable();
            $table->string("telefono","20")->nullable();
            $table->string("token_clave",200)->nullable()->unique();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clientes');
    }
};
