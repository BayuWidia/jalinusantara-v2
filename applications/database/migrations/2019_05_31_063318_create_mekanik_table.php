<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMekanikTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mekanik', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_registrasi')->unsigned()->nullable();
            $table->string('email');
            $table->string('nama_lengkap_mekanik');
            $table->string('nama_mekanik');
            $table->string('golongan_darah_mekanik');
            $table->string('tmp_lahir_mekanik');
            $table->string('no_telp_mekanik');
            $table->string('ukuran_kemeja_mekanik');
            $table->string('alamat_mekanik');
            $table->string('kota_mekanik');
            $table->string('no_anggota_iof');
            $table->string('rhesus');
            $table->date('tgl_lhr_mekanik');
            $table->string('kode_pos');
            $table->string('no_sim_mekanik');
            $table->string('pengalaman_event_mekanik');
            $table->string('activated');
            $table->string('created_by');
            $table->string('updated_by')->nullable();
            $table->timestamps();
        });

        Schema::table('mekanik', function($table){
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
    //     Schema::dropIfExists('mekanik');
    // }
}
