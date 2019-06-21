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
          $table->string('judul')->nullable();
          $table->string('url_video')->nullable();
          $table->integer('flag_important_video')->nullable();
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
        // Schema::dropIfExists('master_video');
    }
}
