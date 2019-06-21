<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Auth;
use DB;

class Menu extends Authenticatable
{
    use Notifiable;

    protected $table = 'master_menus';

    protected $fillable = [
        'id_parent','nama_menu','icon','url','activated','created_by', 'updated_by',
    ];

    public static function getDataMenusById($params){
       $getDataMenusById = DB::select('SELECT * from master_menus where id=:id', ['id' => $params]);
       return $getDataMenusById;
   }

    public static function menusParent(){
      $email = Auth::user()->email;
      $roleId = Auth::user()->id_role;
  		$menusParent = DB::select('SELECT menu.id, menu.id_parent, menu.nama_menu, menu.url
                                FROM master_menus menu
                                INNER JOIN master_access access ON access.id_menu = menu.id
                                INNER JOIN master_users users ON users.id_role = access.id_role
                                INNER JOIN master_roles roles ON roles.id = users.id_role
                                WHERE users.email =:email AND users.id_role =:roleId AND menu.activated = 1
                                AND menu.id_parent = 0 and menu.activated = 1
                                ORDER BY menu.id ASC',['email'=>$email, 'roleId'=>$roleId]);
  		return $menusParent;
  	}

    public static function menusChild($parentId){
      $email = Auth::user()->email;
      $roleId = Auth::user()->id_role;
  		$menusParent = DB::select('SELECT menu.id, menu.id_parent, menu.nama_menu, menu.url
                                FROM master_menus menu
                                INNER JOIN master_access access ON access.id_menu = menu.id
                                INNER JOIN master_users users ON users.id_role = access.id_role
                                INNER JOIN master_roles roles ON roles.id = users.id_role
                                WHERE users.email =:email AND users.id_role =:roleId AND menu.activated = 1
                                AND menu.id_parent =:parentId and menu.activated = 1
                                ORDER BY menu.id ASC',['email'=>$email, 'roleId'=>$roleId, 'parentId'=>$parentId]);
  		return $menusParent;
  	}
}
