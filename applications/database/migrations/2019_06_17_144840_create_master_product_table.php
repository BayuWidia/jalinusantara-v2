<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMasterProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_product', function (Blueprint $table) {
          $table->increments('id');
          $table->string('nama_product');
          $table->string('link_product');
          $table->string('url_product');
          $table->string('keterangan_product');
          $table->string('flag_product');
          $table->string('activated');
          $table->string('created_by');
          $table->string('updated_by');
          $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Schema::dropIfExists('master_product');
    }
}
