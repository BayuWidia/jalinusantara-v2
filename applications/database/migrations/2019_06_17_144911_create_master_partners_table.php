<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMasterPartnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_partners', function (Blueprint $table) {
          $table->increments('id');
          $table->string('nama_partners')->nullable();
          $table->string('link_partners')->nullable();
          $table->string('url_partners')->nullable();
          $table->string('keterangan_partners')->nullable();
          $table->string('flag_partners')->nullable();
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
        Schema::dropIfExists('master_partners');
    }
}
