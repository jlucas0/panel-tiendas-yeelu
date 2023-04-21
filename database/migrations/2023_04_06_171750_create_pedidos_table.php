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
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->enum("f_pago",["stripe","paypal"]);
            $table->string("ref_pago",250);
            $table->float("envio")->unsigned();
            $table->float("descuento")->unsigned()->nullable();
            $table->boolean("completado")->default(false);
            $table->text("observaciones")->nullable();
            $table->enum("estado",['pendiente','aceptado','preparado','enviado','entregado'])->nullable();
            $table->foreignId("cliente_id")->constrained();
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
        Schema::dropIfExists('pedidos');
    }
};
