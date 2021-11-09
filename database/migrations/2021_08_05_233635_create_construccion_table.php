<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConstruccionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('construccion', function (Blueprint $table) {
            $table->id();
            $table->string('folio',50)->unique();
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
            #$table->boolean("info")->default(0);
            #$table->timestamp("solInfopip")->nullable();
            #$table->timestamp("solInfoC")->nullable();
            #$table->string("respuesta")->nullable();
            #$table->string("motivoRetrasoInfo")->nullable();
            #$table->unsignedInteger("diasresrp")->nullable();#respuesta-solinfoC
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
        Schema::dropIfExists('construccion');
    }
}
