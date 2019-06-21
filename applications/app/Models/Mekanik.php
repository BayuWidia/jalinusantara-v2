<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mekanik extends Model
{
    //
    protected $table = 'mekanik';

    protected $fillable = [
        'id_registrasi'
      , 'email'
      , 'nama_lengkap_mekanik'
      , 'nama_mekanik'
      , 'golongan_darah_mekanik'
      , 'tmp_lahir_mekanik'
      , 'no_telp_mekanik'
      , 'ukuran_kemeja_mekanik'
      , 'alamat_mekanik'
      , 'kota_mekanik'
      , 'no_anggota_iof'
      , 'rhesus'
      , 'tgl_lhr_mekanik'
      , 'kode_pos'
      , 'no_sim_mekanik'
      , 'pengalaman_event_mekanik'
      , 'activated'
      , 'created_by'
      , 'updated_by'
    ];

}
