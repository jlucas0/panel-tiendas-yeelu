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
        Schema::dropIfExists('linea_pedidos');
        Schema::create('linea_pedidos', function (Blueprint $table) {
            $table->id();
            $table->smallInteger("cantidad")->unsigned();
            $table->float("precio_ud")->unsigned();
            $table->float("descuento")->unsigned()->nullable();
            $table->foreignId("pedido_id")->constrained();
            $table->foreignId("referencia_id")->constrained();
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
        Schema::dropIfExists('linea_pedidos');
    }
};
