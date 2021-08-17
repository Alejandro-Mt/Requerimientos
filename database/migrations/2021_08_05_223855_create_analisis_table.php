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
            $table->string('folio')->unique;
            $table->string('fechaEnvAnC')->nullable();
            $table->boolean('retraso')->default(0)->nullable();
            $table->string("motivoRet")->nullable();
            $table->unsignedInteger("diasRet")->nullable();
            $table->string('fechaAutC')->nullable();
            $table->unsignedInteger("diasEsp")->nullable();
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
