<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterPesan extends Model
{
    //
    protected $table = 'master_pesan';

    protected $fillable = [
      'email', 'nama', 'telepon', 'isi', 'flag_pesan',
      'activated', 'created_by', 'updated_by',
    ];
}
