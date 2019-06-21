<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterGaleri extends Model
{
    protected $table = 'master_galeri';

    protected $fillable = [
      'id_events', 'judul', 'url_gambar', 'keterangan_gambar', 'flag_gambar', 'activated', 'created_by', 'updated_by',
    ];
}
