<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUrlToMasterSertifikatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('master_Sertifikat', function (Blueprint $table) {
            //
            $table->string('url_sertifikat')->nullable()->after('nama_sertifikat');
            $table->string('flag_sertifikat')->nullable()->after('url_sertifikat');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    // public function down()
    // {
    //     Schema::table('master_Sertifikat', function (Blueprint $table) {
    //         //
    //     });
    // }
}
