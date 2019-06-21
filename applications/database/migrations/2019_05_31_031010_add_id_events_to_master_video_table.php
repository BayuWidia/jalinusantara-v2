<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIdEventsToMasterVideoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('master_video', function (Blueprint $table) {
            $table->integer('id_events')->unsigned()->nullable()->after('id');
        });

        Schema::table('master_video', function($table){
            $table->foreign('id_events')->references('id')->on('events');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    // public function down()
    // {
    //     Schema::table('master_video', function (Blueprint $table) {
    //         //
    //     });
    // }
}
