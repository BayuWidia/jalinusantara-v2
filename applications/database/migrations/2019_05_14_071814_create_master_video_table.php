<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMasterVideoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_video', function (Blueprint $table) {
          $table->increments('id');
          $table->string('judul');
          $table->string('url_video');
          $table->integer('flag_important_video');
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
        // Schema::dropIfExists('master_video');
    }
}
