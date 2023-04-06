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
        Schema::dropIfExists('productos');
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string("codigo",150)->unique();
            $table->string("nombre",200);
            $table->smallInteger("peso")->unsigned()->nullable();
            $table->enum("unidad",["gr","kg","l","ml"])->nullable();
            $table->float("precio")->unsigned();
            $table->float("descuento")->unsigned()->nullable();
            $table->date("fin_descuento")->nullable();
            $table->text("descripcion")->nullable();
            $table->text("ingredientes")->nullable();
            $table->text("valores")->nullable();
            $table->bigInteger("visitas")->unsigned()->default(0);
            $table->integer("stock")->unsigned()->default(0);
            $table->smallInteger("aviso_stock")->default(0);
            $table->boolean("disponible");
            $table->foreignId("marcas")->constrained();
            $table->foreignId("categorias")->constrained();
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
        Schema::dropIfExists('productos');
    }
};
