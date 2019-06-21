<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldToKendaraanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kendaraan', function (Blueprint $table) {
            //
            $table->string('winch_belakang_merek')->nullable()->after('strap');
            $table->string('winch_belakang_type')->nullable()->after('winch_belakang_merek');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    // public function down()
    // {
    //     Schema::table('kendaraan', function (Blueprint $table) {
    //         //
    //     });
    // }
}
