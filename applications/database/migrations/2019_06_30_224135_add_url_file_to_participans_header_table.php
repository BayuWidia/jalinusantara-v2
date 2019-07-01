<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUrlFileToParticipansHeaderTable extends Migration
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
            $table->string('url_file')->nullable()->after('id_event');
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
