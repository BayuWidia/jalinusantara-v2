<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldToRegistrasiEventsTable extends Migration
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
            $table->string('email_co')->nullable()->after('email');
            $table->string('nama_lengkap_driver')->nullable()->after('email_co');
            $table->string('nama_lengkap_co_driver')->nullable()->after('nama_lengkap_driver');
            $table->string('tmp_lahir_driver')->nullable()->after('golongan_darah_co_driver');
            $table->string('tmp_lahir_co_driver')->nullable()->after('tmp_lahir_driver');
            $table->string('ukuran_kemeja_driver')->nullable()->after('tmp_lahir_co_driver');
            $table->string('ukuran_kemeja_co_driver')->nullable()->after('ukuran_kemeja_driver');
            $table->string('alamat_driver')->nullable()->after('ukuran_kemeja_co_driver');
            $table->string('alamat_co_driver')->nullable()->after('alamat_driver');
            $table->string('kota_driver')->nullable()->after('alamat_co_driver');
            $table->string('kota_co_driver')->nullable()->after('kota_driver');
            $table->string('no_anggota_iof')->nullable()->after('kota_co_driver');
            $table->string('no_anggota_iof_co')->nullable()->after('no_anggota_iof');
            $table->string('rhesus')->nullable()->after('no_anggota_iof_co');
            $table->string('rhesus_co')->nullable()->after('rhesus');
            $table->date('tgl_lhr_driver')->nullable()->after('rhesus_co');
            $table->date('tgl_lhr_co_driver')->nullable()->after('tgl_lhr_driver');
            $table->string('kode_pos')->nullable()->after('tgl_lhr_co_driver');
            $table->string('kode_pos_co')->nullable()->after('kode_pos');
            $table->string('no_sim_driver')->nullable()->after('kode_pos_co');
            $table->string('no_sim_co_driver')->nullable()->after('no_sim_driver');
            $table->string('pengalaman_event_driver')->nullable()->after('no_sim_co_driver');
            $table->string('pengalaman_event_co_driver')->nullable()->after('pengalaman_event_driver');

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
