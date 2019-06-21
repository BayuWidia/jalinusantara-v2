<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNoRegistrasiToRegistrasiEventsTable extends Migration
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
            $table->string('no_registrasi')->nullable()->after('id_events');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    // public function down()
    // {
    //     Schema::table('registrasi_events', function (Blueprint $table) {
    //         //
    //     });
    // }
}
