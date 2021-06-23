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
            $table->foreign('id_cliente')->references('id_cliente')->on('cliente')->ondelete('cascade')->onupdate('restrict');
            $table->unsignedBigInteger('id_sistema')->index();
            $table->foreign('id_sistema')->references('id_sistema')->on('sistema')->ondelete('cascade')->onupdate('restrict');
            $table->string('descripcion',50);
            $table->unsignedBigInteger('id_responsable')->index();
            $table->foreign('id_responsable')->references('id_responsable')->on('responsable')->ondelete('cascade')->onupdate('restrict');
            $table->string('bitrix',50);
            $table->string('estatus',50);
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
