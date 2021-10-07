<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLiberacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('liberaciones', function (Blueprint $table) {
            $table->id();
            $table->string('folio');
            $table->timestamp('fecha_lib_a')->nullable();
            $table->timestamp('fecha_lib_r')->nullable();
            $table->unsignedInteger('dif_r_a')->nullable();
            $table->timestamp('inicio_lib')->nullable();
            $table->timestamp('inicio_p_r')->nullable();
            $table->unsignedInteger('dif_p')->nullable();
            $table->unsignedInteger('t_pruebas')->nullable();
            $table->string('evidencia_p')->nullable();
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
        Schema::dropIfExists('liberaciones');
    }
}
