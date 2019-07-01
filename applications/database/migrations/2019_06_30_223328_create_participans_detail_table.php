<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParticipansDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participans_detail', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('id_header')->unsigned()->nullable();
          $table->string('nama')->nullable();
          $table->string('posisi')->nullable();
          $table->string('pax')->nullable();
          $table->string('mobil')->nullable();
          $table->string('nomor_polisi')->nullable();
          $table->string('telephone')->nullable();
          $table->string('ukuran_baju')->nullable();
          $table->string('bahan_bakar')->nullable();
          $table->string('activated')->nullable();
          $table->string('created_by')->nullable();
          $table->string('updated_by')->nullable();
          $table->timestamps();
        });

        Schema::table('participans_detail', function($table){
          $table->foreign('id_header')->references('id')->on('participans_header');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    // public function down()
    // {
    //     Schema::dropIfExists('participans_detail');
    // }
}
