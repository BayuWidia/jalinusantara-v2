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
          $table->string('nama_product')->nullable();
          $table->string('link_product')->nullable();
          $table->string('url_product')->nullable();
          $table->string('keterangan_product')->nullable();
          $table->string('flag_product')->nullable();
          $table->string('activated')->nullable();
          $table->string('created_by')->nullable();
          $table->string('updated_by')->nullable();
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
