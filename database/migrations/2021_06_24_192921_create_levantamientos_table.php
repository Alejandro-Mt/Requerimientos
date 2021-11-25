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
            $table->string('solicitante')->lenght(100);
            $table->Integer('departamento')->lenght(10)->unsigned();
            $table->Integer('jefe_departamento')->lenght(50)->unsigned();
            #$table->foreign('jefe_departamento')->references('id_responsable')->on('responsables')->ondelete('cascade')->onupdate('restrict');
            $table->Integer('autorizacion')->lenght(50)->unsigned();
            #$table->foreign('autorizacion')->references('id_responsable')->on('responsables')->ondelete('cascade')->onupdate('restrict');
            $table->boolean('previo');
            $table->string('problema')->lenght(50);
            $table->string('impacto')->lenght(50);
            $table->string('general')->lenght(50);
            $table->string('detalle')->lenght(50);
            $table->string('esperado')->lenght(50);
            $table->string('relaciones')->lenght(50);
            #$table->foreign('relaciones')->references('id_sistema')->on('sistemas')->ondelete('cascade')->onupdate('restrict');
            $table->string('involucrados')->lenght(50);
            #$table->foreign('involucrados',10)->references('id_responsable')->on('responsables')->ondelete('cascade')->onupdate('restrict');
            $table->timestamps();
           # $table->unsignedInteger("diasResp")->nullable();#FechaRegistro-FechaFormato
            $table->timestamp('fechaaut')->nullable();
            $table->timestamp('fechades')->nullable();
           # $table->unsignedInteger("diasAut")->nullable();#Fechaformato-FechaEstatus
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
