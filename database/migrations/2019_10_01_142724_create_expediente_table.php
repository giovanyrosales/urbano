<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpedienteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expediente', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('exp');
            
            $table->string('solicitante', 150);
            $table->bigInteger('procesos_id')->unsigned(); 
            $table->dateTime('fecha');
            $table->bigInteger('estados_id')->unsigned(); 
            $table->string('mapa', 150)->nullable();
            $table->string('parcela', 150)->nullable();
            $table->string('correo_solicitante', 150)->nullable();
            $table->string('telefono', 150)->nullable();
            $table->decimal('derecho_cancelado', 7, 2)->nullable();
            $table->string('catastral', 150)->nullable();
            $table->string('direccion', 350)->nullable();
            $table->text('comentarios')->nullable();

            $table->foreign('procesos_id')->references('id')->on('procesos');
            $table->foreign('estados_id')->references('id')->on('estados');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('expediente');
    }
}
