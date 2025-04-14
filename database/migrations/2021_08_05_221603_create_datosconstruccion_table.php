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
            $table->string('folio',20)->unique();
            $table->timestamp('fechaCompReqC')->nullable();
            $table->string("evidencia");
            $table->timestamp('fechaCompReqR')->nullable();
            $table->unsignedInteger("difdias")->nullable();#compromisocliente-compromisoReal
            $table->boolean("desfase")->default(0)->nullable();
            $table->string("motivodesfase")->nullable();
            $table->string("motivopausa")->nullable();
            $table->string("evPausa")->nullable();
            $table->timestamp('fechaReact')->nullable();
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
