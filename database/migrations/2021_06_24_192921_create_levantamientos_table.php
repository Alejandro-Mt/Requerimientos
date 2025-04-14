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
            $table->Integer('jefe_departamento')->lenght(50)->unsigned()->nullable();
            $table->Integer('autorizacion')->lenght(50)->unsigned();
            $table->boolean('previo');
            $table->string('problema')->lenght(50);
            $table->string('impacto')->lenght(50);
            $table->string('general')->lenght(50);
            $table->string('detalle')->lenght(50);
            $table->text('esperado');
            $table->string('relaciones')->lenght(50);
            $table->string('areas')->lenght(50);
            $table->string('involucrados')->lenght(50);
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
