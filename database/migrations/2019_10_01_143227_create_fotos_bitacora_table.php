<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFotosBitacoraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fotos_bitacora', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('bitacora_id')->unsigned(); 
            $table->string('url', 100);

            $table->foreign('bitacora_id')->references('id')->on('bitacora');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fotos_bitacora');
    }
}
