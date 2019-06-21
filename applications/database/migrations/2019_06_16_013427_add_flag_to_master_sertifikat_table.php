<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFlagToMasterSertifikatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('master_sertifikat', function (Blueprint $table) {
            //
            $table->string('format_sertifikat')->nullable()->after('flag_sertifikat');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    // public function down()
    // {
    //     Schema::table('master_sertifikat', function (Blueprint $table) {
    //         //
    //     });
    // }
}
