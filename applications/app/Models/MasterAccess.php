<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterAccess extends Model
{

    protected $table = 'master_access';

    protected $fillable = [
      'id_menu', 'id_role', 'activated', 'created_by', 'updated_by',
    ];

    public function menus()
    {
      return $this->belongsTo('App\Models\Menu', 'id_menu');
    }

    public function roles()
    {
      return $this->belongsTo('App\Models\MasterRoles', 'id_role');
    }
}
