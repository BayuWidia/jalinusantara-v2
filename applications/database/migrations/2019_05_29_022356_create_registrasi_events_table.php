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
            $table->string('nama_driver')->nullable();
            $table->string('nama_co_driver')->nullable();
            $table->string('golongan_darah_driver')->nullable();
            $table->string('golongan_darah_co_driver')->nullable();
            $table->string('no_telp_driver')->nullable();
            $table->string('no_telp_co_driver')->nullable();
            $table->string('mobil')->nullable();
            $table->string('no_polisi')->nullable();
            $table->string('bahan_bakar')->nullable();
            $table->string('ukuran_kemeja_driver')->nullable();
            $table->string('ukuran_kemeja_co_driver')->nullable();
            $table->string('pax')->nullable();
            $table->string('penumpang_1')->nullable();
            $table->string('penumpang_2')->nullable();
            $table->string('activated')->nullable();
            $table->string('created_by')->nullable();
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
