<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_kategori')->unsigned()->nullable();
            $table->string('judul_event');
            $table->date('tanggal_mulai');
            $table->date('tanggal_akhir');
            $table->string('url_foto')->nullable();
            $table->string('tags')->nullable();
            $table->longText('isi_event');
            $table->string('maps');
            $table->string('fasilitator');
            $table->string('jumlah_peserta');
            $table->string('lokasi');
            //0:bukan headline, 1:headline.
            $table->integer('flag_headline')->default(0);
            //0:belum publish, 1:publish.
            $table->integer('flag_publish')->default(0);
            //0:biasa, 1:jadi pioritas.
            $table->integer('flag_headline_utama');
            $table->integer('view_counter');
            $table->string('activated');
            $table->string('created_by');
            $table->string('updated_by');
            $table->timestamps();
          });

          Schema::table('events', function($table){
            $table->foreign('id_kategori')->references('id')->on('master_kategori');
          });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::dropIfExists('events');
    }
}
