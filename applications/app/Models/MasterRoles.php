<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterRoles extends Model
{
    //
    protected $table = 'master_roles';

    protected $fillable = [
      'nama_role', 'keterangan',
      'activated', 'created_by', 'updated_by',
    ];
}
