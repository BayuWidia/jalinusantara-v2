<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterMedsos extends Model
{
    //
    protected $table = 'master_medsos';

    protected $fillable = [
      'nama_sosmed', 'link_sosmed', 'activated', 'created_by', 'updated_by',
    ];
}
