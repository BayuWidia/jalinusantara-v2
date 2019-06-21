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
          $table->string('nama_partners');
          $table->string('link_partners');
          $table->string('url_partners');
          $table->string('keterangan_partners');
          $table->string('flag_partners');
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
        Schema::dropIfExists('master_partners');
    }
}
