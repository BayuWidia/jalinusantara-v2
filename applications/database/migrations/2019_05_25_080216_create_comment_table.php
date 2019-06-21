<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_comment', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('id_informasi')->unsigned()->nullable();
          $table->string('email')->nullable();
          $table->string('nama')->nullable();
          $table->string('subject')->nullable();
          $table->string('message')->nullable();
          $table->string('flag_comment')->nullable();
          $table->string('activated')->nullable();
          $table->string('created_by')->nullable();
          $table->string('updated_by')->nullable();
          $table->timestamps();
        });

        Schema::table('master_comment', function($table){
          $table->foreign('id_informasi')->references('id')->on('informasi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::dropIfExists('master_comment');
    }
}
