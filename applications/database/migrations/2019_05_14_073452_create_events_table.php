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
            $table->string('judul_event')->nullable();
            $table->date('tanggal_mulai')->nullable();
            $table->date('tanggal_akhir')->nullable();
            $table->string('url_foto')->nullable();
            $table->string('tags')->nullable();
            $table->longText('isi_event')->nullable();
            $table->string('maps')->nullable();
            $table->string('fasilitator')->nullable();
            $table->string('jumlah_peserta')->nullable();
            $table->string('lokasi')->nullable();
            //0:bukan headline, 1:headline.
            $table->integer('flag_headline')->nullable()->default(0);
            //0:belum publish, 1:publish.
            $table->integer('flag_publish')->nullable()->default(0);
            //0:biasa, 1:jadi pioritas.
            // $table->integer('flag_headline_utama')->nullable();
            $table->integer('view_counter')->nullable();
            $table->string('activated')->nullable();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
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
