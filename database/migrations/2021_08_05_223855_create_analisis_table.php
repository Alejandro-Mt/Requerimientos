<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnalisisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('analisis', function (Blueprint $table) {
            $table->id();
            $table->string('folio',20)->unique();
            $table->timestamp('fechaCompReqC');
            $table->string("evidencia");
            $table->timestamp('fechaCompReqR');
            $table->unsignedInteger("difdias")->nullable();#compromisocliente-compromisoReal
            $table->unsignedSmallInteger("desfase")->default(0)->nullable();
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
        Schema::dropIfExists('analisis');
    }
}
