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
        Schema::dropIfExists('favoritas');
        Schema::create('favoritas', function (Blueprint $table) {
            $table->bigInteger("tienda_id")->unsigned();
            $table->bigInteger("cliente_id")->unsigned();
            $table->foreign("tienda_id")->references("id")->on("tiendas");
            $table->foreign("cliente_id")->references("id")->on("clientes");
            $table->primary(["tienda_id","cliente_id"]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('favoritas');
    }
};
