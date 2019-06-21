<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRekomendasiToMasterSponsorTable extends Migration
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
            $table->string('rekomendasi')->nullable()->after('keterangan_sponsor');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('master_sponsor', function (Blueprint $table) {
        //     //
        // });
    }
}
