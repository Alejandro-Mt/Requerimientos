<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatosconstruccionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planeacion', function (Blueprint $table) {
            $table->id();
            $table->string('folio')->unique();
            $table->string('fechaCompReqC');
            $table->string("evidencia");
            $table->string('fechaCompReqR');
            $table->unsignedInteger("difdias")->nullable();#compromisocliente-compromisoReal
            $table->unsignedSmallInteger("desface")->default(0)->nullable();
            $table->string("motivodesface")->nullable();
            $table->string("motivopausa")->nullable();
            $table->string("evPausa")->nullable();
            $table->string('fechaReact')->nullable();
            $table->unsignedInteger("diaspausa")->nullable();
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
        Schema::dropIfExists('planeacion');
    }
}
