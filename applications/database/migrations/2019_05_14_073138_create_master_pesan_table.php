<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMasterPesanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_pesan', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email')->nullable();
            $table->string('nama')->nullable();
            $table->string('telepon')->nullable();
            $table->string('isi')->nullable();
            $table->string('flag_pesan')->nullable();
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
        // Schema::dropIfExists('master_pesan');
    }
}
