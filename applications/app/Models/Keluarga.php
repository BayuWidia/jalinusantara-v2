<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keluarga extends Model
{
    //
    protected $table = 'keluarga';

    protected $fillable = [
      'id_registrasi', 'nama_lengkap_keluarga' ,'nama_keluarga', 'email',
      'hubungan_keluarga', 'no_telp_keluarga', 'no_hp_keluarga',
      'activated', 'created_by', 'updated_by',
    ];

}
