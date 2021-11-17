<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncidenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incidencias', function (Blueprint $table) {
            $table->id('id_incidencia');
            /*$table->string('Correo',50);
            $table->string('Plataforma',50);
            $table->string('Version',50);
            $table->string('Modulo',50);
            $table->string('Seccion',50);
            $table->string('idContexto',50);
            $table->unsignedBigInteger('id_area')->index();
            $table->boolean('Desarrollo')->default(0);
            $table->timestamp('Informe_D');
            $table->string('Evidencia',100)->nullable();
            $table->string('Observaciones',255)->nullable();
            $table->string('Adicion',100)->nullable();
            $table->string('Comentarios',255)->nullable();
            $table->boolean('Retraso')->default(0);
            $table->unsignedBigInteger('id_motivo')->index()->nullable();*/
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
}
