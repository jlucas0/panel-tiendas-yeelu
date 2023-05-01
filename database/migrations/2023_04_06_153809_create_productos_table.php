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
            $table->string("codigo",150)->nullable()->unique();
            $table->string("nombre",200);
            $table->smallInteger("peso")->unsigned()->nullable();
            $table->enum("unidad",["gr","kg","l","ml"])->nullable();
            $table->text("descripcion")->nullable();
            $table->text("ingredientes")->nullable();
            $table->smallInteger("kcal")->unsigned()->nullable();
            $table->float("grasas")->unsigned()->nullable();
            $table->float("saturadas")->unsigned()->nullable();
            $table->float("hidratos")->unsigned()->nullable();
            $table->float("azucar")->unsigned()->nullable();
            $table->float("proteinas")->unsigned()->nullable();
            $table->float("sal")->unsigned()->nullable();
            $table->boolean("confirmado");
            $table->foreignId("marca_id")->constrained();
            $table->foreignId("subsubcategoria_id")->constrained();
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
