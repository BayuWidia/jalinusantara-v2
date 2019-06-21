<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMasterSponsorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_sponsor', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_sponsor');
            $table->string('link_sponsor');
            $table->string('url_sponsor');
            $table->string('keterangan_sponsor');
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
        // Schema::dropIfExists('master_sponsor');
    }
}
