<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocResTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doc_res', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('resoluciones_id')->unsigned(); 
            $table->string('url', 100);

            $table->foreign('resoluciones_id')->references('id')->on('resoluciones');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('doc_res');
    }
}
