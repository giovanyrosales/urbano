<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocExpTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doc_exp', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('expediente_id')->unsigned(); 
            $table->string('url', 100);

            $table->foreign('expediente_id')->references('id')->on('expediente');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('doc_exp');
    }
}
