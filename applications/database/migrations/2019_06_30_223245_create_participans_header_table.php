<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParticipansHeaderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participans_header', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('id_event')->unsigned()->nullable();
          $table->string('nomor_pintu')->nullable();
          $table->string('activated')->nullable();
          $table->string('created_by')->nullable();
          $table->string('updated_by')->nullable();
          $table->timestamps();
        });

        Schema::table('participans_header', function($table){
          $table->foreign('id_event')->references('id')->on('events');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    // public function down()
    // {
    //     Schema::dropIfExists('participans_header');
    // }
}
