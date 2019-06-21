<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Session;

class RenderMenu extends Model
{

  	public static function renderMenuRole($email, $roleId){
  		$renderMenuRole = DB::select('SELECT menu.id, menu.id_parent, menu.nama_menu, menu.url
                                FROM master_menus menu
                                INNER JOIN master_access access ON access.id_menu = menu.id
                                INNER JOIN master_users users ON users.id_role = access.id_role
                                INNER JOIN master_roles roles ON roles.id = users.id_role
                                WHERE users.email =:email AND users.id_role =:roleId AND menu.activated = 1
                                AND menu.nama_menu <> "" AND menu.nama_menu IS NOT NULL
                                ORDER BY menu.nama_menu ASC',['email'=>$email, 'roleId'=>$roleId]);
  		return $renderMenuRole;
  	}
}
