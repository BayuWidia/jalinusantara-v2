<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterSertifikat extends Model
{
    //
    protected $table = 'master_sertifikat';

    protected $fillable = [
      'nama_sertifikat', 'url_sertifikat', 'flag_sertifikat', 'format_sertifikat','keterangan_sertifikat', 'activated', 'created_by', 'updated_by',
    ];
}
