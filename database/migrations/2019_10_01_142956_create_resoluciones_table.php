<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResolucionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resoluciones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('num_res');
            $table->date('fecha_resolucion');

            $table->bigInteger('exp_id')->unsigned();
            $table->decimal('monto', 7, 2)->nullable();
            $table->date('fecha')->nullable();
            $table->string('recibe', 150)->nullable();
            
            $table->foreign('exp_id')->references('id')->on('expediente');
        });
    } 

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('resoluciones');
    }
}
