<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistroTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registros', function (Blueprint $table) {
            $table->id('id_registro');
            $table->unsignedBigInteger('id_cliente')->index();
            $table->foreign('id_cliente')->references('id_cliente')->on('clientes')->ondelete('cascade')->onupdate('restrict');
            $table->unsignedBigInteger('id_sistema')->index();
            $table->foreign('id_sistema')->references('id_sistema')->on('sistemas')->ondelete('cascade')->onupdate('restrict');
            $table->string('descripcion',50);
            $table->unsignedBigInteger('id_responsable')->index();
            $table->foreign('id_responsable')->references('id_responsable')->on('responsables')->ondelete('cascade')->onupdate('restrict');
            $table->string('folio',50);
            $table->unsignedBigInteger('id_estatus');
            $table->foreign('id_estatus')->references('id_estatus')->on('estatus')->ondelete('cascade')->onupdate('restrict');
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
        Schema::dropIfExists('registros');
    }
}
