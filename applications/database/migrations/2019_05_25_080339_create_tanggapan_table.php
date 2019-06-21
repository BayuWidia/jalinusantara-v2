<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTanggapanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_tanggapan', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_comment')->unsigned()->nullable();
            $table->string('tanggapan');
            $table->string('activated');
            $table->string('created_by')->nullable();
            $table->string('updated_by');
            $table->timestamps();
        });

        Schema::table('master_tanggapan', function($table){
          $table->foreign('id_comment')->references('id')->on('master_comment');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::dropIfExists('master_tanggapan');
    }
}
