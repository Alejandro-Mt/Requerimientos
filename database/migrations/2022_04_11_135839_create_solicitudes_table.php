<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolicitudesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitudes', function (Blueprint $table) {
            $table->id();
            $table->string('solicitante')->length( 250);
            $table->string('correo')->length( 250);
            $table->integer('id_cliente')->length(10)->unsigned()->index();
            $table->Integer('id_sistema')->length(10)->unsigned()->index();
            $table->string('descripcion')->length( 250);
            $table->string('folio')->length(50)->unique();
            $table->Integer('id_estatus')->length(10)->unsigned();
            $table->string('folior')->length(50)->unique();
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
        Schema::dropIfExists('solicitudes');
    }
}
