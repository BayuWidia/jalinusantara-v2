<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldToKeluargaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('keluarga', function (Blueprint $table) {
            //
            $table->string('email')->nullable()->after('nama_keluarga');
            $table->string('nama_lengkap_keluarga')->nullable()->after('id_registrasi');
            $table->string('no_hp_keluarga')->nullable()->after('no_telp_keluarga');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    // public function down()
    // {
    //     Schema::table('keluarga', function (Blueprint $table) {
    //         //
    //     });
    // }
}
