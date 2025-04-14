<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInformacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('informacion', function (Blueprint $table) {
            $table->id();
            $table->String("folio",50);
            $table->timestamp("solInfopip")->nullable();
            $table->string("detalle");
            $table->timestamp("solInfoC")->nullable();
            $table->timestamp("respuesta")->nullable();
            $table->boolean("retraso")->nullable();
            $table->string("motivoRetrasoInfo")->nullable();
            $table->unsignedInteger("diasresrp")->nullable();#respuesta-solinfoC
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
        Schema::dropIfExists('informacion');
    }
}
