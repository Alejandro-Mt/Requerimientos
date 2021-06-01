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
        Schema::create('registro', function (Blueprint $table) {
            $table->id('Folio');
            $table->string('Estatus',50);
            $table->unsignedBigInteger('id_cliente')->index();
            $table->foreign('id_cliente')->references('id_cliente')->on('cliente')->ondelete('cascade')->onupdate('restrict');
            $table->unsignedBigInteger('id_sistema')->index();
            $table->foreign('id_sistema')->references('id_sistema')->on('sistema')->ondelete('cascade')->onupdate('restrict');
            $table->string('Descripcion',50);
            $table->unsignedBigInteger('id_prioridad')->index();
            $table->foreign('id_prioridad')->references('id_prioridad')->on('prioridad')->ondelete('cascade')->onupdate('restrict');
            $table->unsignedBigInteger('id_responsable')->index();
            $table->foreign('id_responsable')->references('id_responsable')->on('responsable')->ondelete('cascade')->onupdate('restrict');
            $table->unsignedBigInteger('id_solicita')->index();
            $table->foreign('id_solicita')->references('id_solicita')->on('solicita')->ondelete('cascade')->onupdate('restrict');
            $table->string('Bitrix',50);
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
        Schema::dropIfExists('registro');
    }
}
