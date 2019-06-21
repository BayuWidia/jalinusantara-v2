<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterTanggapan extends Model
{
    //
    protected $table = 'master_tanggapan';

    protected $fillable = [
      'id_comment', 'tanggapan',
      'activated', 'created_by', 'updated_by',
    ];
}
