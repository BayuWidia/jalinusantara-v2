<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInformasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('informasi', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_kategori')->unsigned()->nullable();
            $table->string('judul_informasi')->nullable();
            $table->date('tanggal_publish')->nullable();
            $table->string('url_foto')->nullable();
            $table->string('tags')->nullable();
            $table->longText('isi_informasi')->nullable();
            //0:bukan headline, 1:headline.
            $table->integer('flag_headline')->nullable()->default(0);
            //0:belum publish, 1:publish.
            $table->integer('flag_publish')->nullable()->default(0);
            $table->integer('view_counter')->nullable();
            $table->string('activated')->nullable();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->timestamps();
          });

          Schema::table('informasi', function($table){
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
        // Schema::dropIfExists('informasi');
    }
}
