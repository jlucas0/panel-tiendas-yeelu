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
         Schema::dropIfExists('facturas');
        Schema::create('facturas', function (Blueprint $table) {
            $table->id();
            $table->string("nombre",100);
            $table->string("apellidos",200);
            $table->string("direccion",250);
            $table->smallInteger("cp")->unsigned();
            $table->string("ciudad",200);
            $table->string("nif",15)->nullable();
            $table->foreignId("pedido_id")->constrained();
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
        Schema::dropIfExists('facturas');
    }
};
