<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImplementacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('implementaciones', function (Blueprint $table) {
            $table->id();
            $table->string('folio');
            $table->boolean('cronograma')->nullable();
            $table->string('link_c')->nullable();
            $table->timestamp('f_implementacion')->nullable();
            $table->string('estatus_f')->nullable();
            $table->string('seguimiento')->nullable();
            $table->string('comentarios')->nullable();
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
        Schema::dropIfExists('implementaciones');
    }
}
