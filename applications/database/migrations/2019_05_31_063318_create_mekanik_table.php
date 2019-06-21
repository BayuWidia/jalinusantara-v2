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
            $table->string('email')->nullable();
            $table->string('nama_lengkap_mekanik')->nullable();
            $table->string('nama_mekanik')->nullable();
            $table->string('golongan_darah_mekanik')->nullable();
            $table->string('tmp_lahir_mekanik')->nullable();
            $table->string('no_telp_mekanik')->nullable();
            $table->string('ukuran_kemeja_mekanik')->nullable();
            $table->string('alamat_mekanik')->nullable();
            $table->string('kota_mekanik')->nullable();
            $table->string('no_anggota_iof')->nullable();
            $table->string('rhesus')->nullable();
            $table->date('tgl_lhr_mekanik')->nullable();
            $table->string('kode_pos')->nullable();
            $table->string('no_sim_mekanik')->nullable();
            $table->string('pengalaman_event_mekanik')->nullable();
            $table->string('activated')->nullable();
            $table->string('created_by')->nullable();
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
