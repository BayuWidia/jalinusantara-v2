<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFlagPublishToParticipansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('participans_header', function (Blueprint $table) {
            //
            $table->string('flag_publish')->nullable()->after('id_event');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    // public function down()
    // {
    //     Schema::table('participans_header', function (Blueprint $table) {
    //         //
    //     });
    // }
}
