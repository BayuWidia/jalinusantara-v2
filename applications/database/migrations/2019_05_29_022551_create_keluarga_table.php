<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKeluargaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keluarga', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_registrasi')->unsigned()->nullable();
            $table->string('nama_keluarga');
            $table->string('hubungan_keluarga');
            $table->string('no_telp_keluarga');
            $table->string('activated');
            $table->string('created_by');
            $table->string('updated_by')->nullable();
            $table->timestamps();
        });

        Schema::table('keluarga', function($table){
          $table->foreign('id_registrasi')->references('id')->on('registrasi_events');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    // public function down()
    // {
    //     Schema::dropIfExists('contact_registrasi');
    // }
}
