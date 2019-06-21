<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRegistToRegisterEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('registrasi_events', function (Blueprint $table) {
            //
            $table->string('file_name')->nullable()->after('flag_approve');
            $table->string('status_register')->nullable()->after('file_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    // public function down()
    // {
    //     Schema::table('register_events', function (Blueprint $table) {
    //         //
    //     });
    // }
}
