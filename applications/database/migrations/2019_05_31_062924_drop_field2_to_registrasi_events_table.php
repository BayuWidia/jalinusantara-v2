<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropField2ToRegistrasiEventsTable extends Migration
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
            $table->dropColumn(['mobil', 'no_polisi', 'bahan_bakar', 'pax', 'penumpang_1', 'penumpang_2']);
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
