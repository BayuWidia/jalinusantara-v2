<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistrasiEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registrasi_events', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_events')->unsigned()->nullable();
            $table->string('nama_driver');
            $table->string('nama_co_driver');
            $table->string('golongan_darah_driver');
            $table->string('golongan_darah_co_driver');
            $table->string('no_telp_driver');
            $table->string('no_telp_co_driver');
            $table->string('mobil');
            $table->string('no_polisi');
            $table->string('bahan_bakar');
            $table->string('ukuran_kemeja_driver');
            $table->string('ukuran_kemeja_co_driver');
            $table->string('pax');
            $table->string('penumpang_1');
            $table->string('penumpang_2');
            $table->string('activated');
            $table->string('created_by');
            $table->string('updated_by')->nullable();
            $table->timestamps();
        });

        Schema::table('registrasi_events', function($table){
          $table->foreign('id_events')->references('id')->on('events');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    // public function down()
    // {
    //     Schema::dropIfExists('registrasi_events');
    // }
}
