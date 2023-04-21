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
        Schema::dropIfExists('marcas');
        Schema::create('marcas', function (Blueprint $table) {
            $table->id();
            $table->string("nombre",150);
            $table->string("foto",100)->nullable();
            $table->text("descripcion")->nullable();
            $table->foreignId("tienda_id")->nullable()->constrained();
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
        Schema::dropIfExists('marcas');
    }
};
