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
            $table->string('folio')->unique;
            $table->boolean("desface")->default(0);
            $table->string("motivoDesface")->nullable();
            $table->boolean("info")->default(0);
            $table->string("solInfopip")->nullable();
            $table->string("solInfoC")->nullable();
            $table->string("respuesta")->nullable();
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
        Schema::dropIfExists('construccion');
    }
}
