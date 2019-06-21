<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldToMasterSponsorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('master_sponsor', function (Blueprint $table) {
            //
            $table->integer('id_events')->unsigned()->nullable()->after('id');
        });

        Schema::table('master_sponsor', function($table){
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
    //     Schema::table('master_sponsor', function (Blueprint $table) {
    //         //
    //     });
    // }
}
