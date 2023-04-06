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
        Schema::dropIfExists('direccions');
        Schema::create('direccions', function (Blueprint $table) {
            $table->id();
            $table->string("nombre",100);
            $table->string("apellidos",200);
            $table->string("direccion",250);
            $table->smallInteger("cp")->unsigned();
            $table->string("ciudad",200);
            $table->string("nif",15)->nullable();
            $table->decimal("latitud");
            $table->decimal("longitud");
            $table->boolean("predeterminada");
            $table->boolean("factura")->default(false);
            $table->foreignId("clientes")->constrained();
            $table->smallInteger("provincia_id")->unsigned();
            $table->foreign("provincia_id")->references("codigo")->on("provincias");
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
        Schema::dropIfExists('direccions');
    }
};
