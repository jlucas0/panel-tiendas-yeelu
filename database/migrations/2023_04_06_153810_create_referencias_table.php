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
        Schema::dropIfExists('referencias');
        Schema::create('referencias', function (Blueprint $table) {
            $table->id();
            $table->string("codigo",150);
            $table->float("precio")->unsigned();
            $table->float("descuento")->unsigned()->nullable();
            $table->date("fin_descuento")->nullable();
            $table->bigInteger("visitas")->unsigned()->default(0);
            $table->integer("maximo_venta")->nullable()->unsigned();
            $table->boolean("disponible");
            $table->foreignId("producto_id")->constrained();
            $table->foreignId("tienda_id")->constrained();
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
        Schema::dropIfExists('referencias');
    }
};
