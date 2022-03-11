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
            $table->id('id_registro')->length(10);
            $table->integer('id_cliente')->length(10)->unsigned()->index();
            #$table->foreign('id_cliente',5)->references('id_cliente')->on('clientes')->ondelete('cascade')->onupdate('restrict');
            $table->Integer('id_sistema')->length(10)->unsigned()->index();
            #$table->foreign('id_sistema')->references('id_sistema')->on('sistemas')->ondelete('cascade')->onupdate('restrict');
            $table->string('descripcion')->length(150);
            $table->Integer('id_responsable')->length(10)->unsigned()->index();
            #$table->foreign('id_responsable')->references('id_responsable')->on('responsables')->ondelete('cascade')->onupdate('restrict');
            $table->string('folio')->length(50)->unique();
            $table->Integer('id_estatus')->length(10)->unsigned();
            #$table->foreign('id_estatus')->references('id_estatus')->on('estatus')->ondelete('cascade')->onupdate('restrict');
            $table->Integer('id_area')->length(10)->unsigned();
            #$table->foreign('id_area')->references('id_area')->on('areas')->ondelete('cascade')->onupdate('restrict');
            $table->integer('id_arquitecto')->length(10)->nullable()->unsigned();
            #$table->foreign('id_puesto')->references('id_puesto')->on('puestos')->ondelete('cascade')->onUpdate('restrict');
            $table->integer('id_clase')->length(10)->nullable()->unsigned();
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
