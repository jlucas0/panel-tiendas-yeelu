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
        Schema::dropIfExists('etiqueta_producto');
        Schema::create('etiqueta_producto', function (Blueprint $table) {
            $table->bigInteger("etiqueta_id")->unsigned();
            $table->bigInteger("producto_id")->unsigned();
            $table->foreign("etiqueta_id")->references("id")->on("etiquetas");
            $table->foreign("producto_id")->references("id")->on("productos");
            $table->primary(["etiqueta_id","producto_id"]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('etiqueta_producto');
    }
};
