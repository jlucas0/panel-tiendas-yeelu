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
        Schema::dropIfExists('incidencias');
        Schema::create('incidencias', function (Blueprint $table) {
            $table->id();
            $table->enum("estado",["pendiente","resuelta"])->default("pendiente");
            $table->enum("motivo",["stock","otro"]);
            $table->text("observaciones");
            $table->foreignId("pedidos")->constrained();
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
        Schema::dropIfExists('incidencias');
    }
};
