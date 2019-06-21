<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterPartners extends Model
{
    //
    protected $table = 'master_partners';

    protected $fillable = [
      'nama_partners', 'link_partners', 'url_partners', 'keterangan_partners', 'flag_partners',
      'activated', 'created_by', 'updated_by',
    ];
}
