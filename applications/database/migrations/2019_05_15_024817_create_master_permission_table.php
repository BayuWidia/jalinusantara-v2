<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMasterPermissionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_permission', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_menu')->unsigned()->nullable();
            $table->integer('id_role')->unsigned()->nullable();
            $table->string('activated')->nullable();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->timestamps();
        });

        Schema::table('master_permission', function($table){
          $table->foreign('id_menu')->references('id')->on('master_menus');
        });

        Schema::table('master_permission', function($table){
          $table->foreign('id_role')->references('id')->on('master_roles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::dropIfExists('master_permission');
    }
}
