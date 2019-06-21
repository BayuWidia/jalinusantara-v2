<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKendaraanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kendaraan', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_registrasi')->unsigned()->nullable();
            $table->string('merek')->nullable();
            $table->string('no_polisi')->nullable();
            $table->string('type_mesin')->nullable();
            $table->string('cc')->nullable();
            $table->string('merek_ban')->nullable();
            $table->string('ukuran_ban')->nullable();
            $table->string('rollbar')->nullable();
            $table->string('cargo_barrier')->nullable();
            $table->string('side_bar')->nullable();
            $table->string('safety_belt')->nullable();
            $table->string('spec_up_kendaraan')->nullable();
            $table->string('type')->nullable();
            $table->string('tahun')->nullable();
            $table->string('warna')->nullable();
            $table->string('snorkel')->nullable();
            $table->string('engine_cut_off')->nullable();
            $table->string('gps')->nullable();
            $table->string('radio_komunikasi')->nullable();
            $table->string('winch_depan_merek')->nullable();
            $table->string('winch_depan_type')->nullable();
            $table->string('strap')->nullable();
            $table->string('winch_belakang')->nullable();
            $table->string('snatch_block')->nullable();
            $table->string('shackle')->nullable();
            $table->string('glove')->nullable();
            $table->string('sling')->nullable();
            $table->string('created_by');
            $table->string('updated_by')->nullable();
            $table->timestamps();
        });


        Schema::table('kendaraan', function($table){
          $table->foreign('id_registrasi')->references('id')->on('registrasi_events');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kendaraan');
    }
}
