<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use phpDocumentor\Reflection\Types\Nullable;

class CreateLevantamientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('levantamientos', function (Blueprint $table) {
            $table->id();
            $table->string('folio',50)->unique();
            $table->string('solicitante');
            $table->unsignedBigInteger('jefe_departamento');
            $table->foreign('jefe_departamento')->references('id_responsable')->on('responsables')->ondelete('cascade')->onupdate('restrict');
            $table->unsignedBigInteger('autorizacion');
            $table->foreign('autorizacion')->references('id_responsable')->on('responsables')->ondelete('cascade')->onupdate('restrict');
            $table->boolean('previo');
            $table->string('problema');
            $table->string('impacto');
            $table->string('general');
            $table->string('detalle');
            $table->string('esperado');
            $table->string('relaciones',20);
            $table->foreign('relaciones',20)->references('id_sistema')->on('sistemas')->ondelete('cascade')->onupdate('restrict');
            $table->string('involucrados',10);
            $table->foreign('involucrados',10)->references('id_responsable')->on('responsables')->ondelete('cascade')->onupdate('restrict');
            $table->timestamps();
            $table->unsignedInteger("diasResp")->nullable();#FechaRegistro-FechaFormato
            $table->string("estatusAut")->nullable();
            $table->unsignedInteger("diasAut")->nullable();#Fechaformato-FechaEstatus
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('levantamientos');
    }
}
