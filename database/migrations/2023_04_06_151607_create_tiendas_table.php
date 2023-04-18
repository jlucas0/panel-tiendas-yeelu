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
        Schema::dropIfExists('tiendas');
        Schema::create('tiendas', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('password');
            $table->string("nombre",200);
            $table->string("foto",50);
            $table->string("logo",50);
            $table->string("video",50)->nullable();
            $table->string("direccion",200);
            $table->smallInteger("cp")->unsigned();
            $table->text("descripcion")->nullable();
            $table->decimal("latitud");
            $table->decimal("longitud");
            $table->boolean("destacada")->default(false);
            $table->float("coste_envio")->unsigned()->nullable();
            $table->float("envio_gratis")->unsigned()->nullable();
            $table->float("pedido_minimo")->unsigned()->nullable();
            $table->string("tiempo_envio",30)->nullable();
            $table->string("color1",8)->nullable();
            $table->string("color2",8)->nullable();
            $table->string("color3",8)->nullable();
            $table->tinyInteger("accesos_mal")->unsigned()->default(0);
            $table->dateTime("bloqueo_acceso")->nullable();
            $table->smallInteger("provincia_id")->unsigned();
            $table->boolean("activa")->default(true);
            $table->foreign("provincia_id")->references("codigo")->on("provincias");
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
        Schema::dropIfExists('tiendas');
    }
};
