<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFlagToRegistrasiEventsTable extends Migration
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
            $table->string('nomor_pintu')->nullable()->after('penumpang_2');
            $table->string('flag_approve')->nullable()->after('nomor_pintu');
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
