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
        Schema::dropIfExists('fotos');
        Schema::create('fotos', function (Blueprint $table) {
            $table->id();
            $table->boolean("principal")->default(false);
            $table->string("direccion",50);
            $table->string("descripcion",250)->nullable();
            $table->foreignId("producto_id")->constrained();
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
        Schema::dropIfExists('fotos');
    }
};
