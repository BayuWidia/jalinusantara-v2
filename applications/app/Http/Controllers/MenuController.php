<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Image;
use Validator;
use DB;
use App\Models\MasterRoles;
use App\Models\MasterAccess;
use App\Models\Menu;
use App\Http\Requests;


class MenuController extends Controller
{

    public function __construct()
    {
        $this->middleware('isAdmin');
    }

    public function index()
    {
        //
        $getListMenu = Menu::where('id_parent', '=', '0')->get();
        $getMenuParent = Menu::where('id_parent', '=', '0')->where('url', '=', '#')->get();
        $getRole = DB::table('master_roles')->select('*')->orderBy('id', 'ASC')->get();
        return view('backend.menu.kelolaMenu', compact('getMenuParent', 'getRole','getListMenu'));
    }


    public function store(Request $request)
    {
      // dd($request->all());
          $messages = [
            'namaMenu.required' => 'Tidak boleh kosong.',
            'urlMenu.required' => 'Tidak boleh kosong.',
            'statusMenu.required' => 'Tidak boleh kosong.',
            'activated.required' => 'Tidak boleh kosong.',
          ];

          $validator = Validator::make($request->all(), [
                  'namaMenu' => 'required',
                  'urlMenu' => 'required',
                  'activated' => 'required',
              ], $messages);

          if ($validator->fails()) {
              return redirect()->route('menu.index')->withErrors($validator)->withInput();
          }

          DB::transaction(function() use($request) {
            $parent="";
            if($request->statusMenu != "0") {
              $parent = $request->parentId;
            } else {
              $parent = 0;
            }

            $menu = Menu::create([
                  'id_parent'  => $parent,
                  'nama_menu'  => $request->namaMenu,
                  'icon'       => $request->icon,
                  'url'        => $request->urlMenu,
                  'activated'  => $request->activated,
                  'created_by' => Auth::user()->id,
            ]);

              $dataRoles = $request->input('idrole');
              foreach($dataRoles as $dataRole){
                $set = new MasterAccess;
                $set->id_menu    = $menu->id;
                $set->id_role    = $dataRole;
                $set->activated  = $request->activated;
                $set->created_by = Auth::user()->id;
                $set->save();
              }
          });

          \LogActivities::insLogActivities('log insert successfully.');

          return redirect()->route('menu.index')->with('message', 'Berhasil memasukkan menu baru.');
    }


    public function edit($id)
    {
        $get = Menu::find($id);
        return $get;
    }

    public function getMenuChild($id)
    {
      $getMenuChild = DB::table('master_menus')
                      ->select('*')
                      ->where('id_parent','=',$id)
                      ->get();
      return $getMenuChild;
    }

    public function getRoleChecked($id)
    {
      $getRoleChecked = MasterRoles::leftJoin('master_access','master_roles.id','=','master_access.id_role')
          ->select(['master_roles.id as role_id'])
          ->where('master_access.id_menu','=',$id)
          ->orderBy('master_roles.id', 'ASC')->get();
      return $getRoleChecked;
    }

    public function update(Request $request)
    {
        // dd($request->all());
        $messages = [
          'id.required' => 'Tidak boleh kosong.',
          'namaMenuEdit.required' => 'Tidak boleh kosong.',
          'urlMenuEdit.required' => 'Tidak boleh kosong.',
          'statusMenuEdit.required' => 'Tidak boleh kosong.',
        ];

        $validator = Validator::make($request->all(), [
                'id' => 'required',
                'namaMenuEdit' => 'required',
                'urlMenuEdit' => 'required',
                'statusMenuEdit' => 'required',
            ], $messages);

        if ($validator->fails()) {
            return redirect()->route('menu.index')->withErrors($validator)->withInput();
        }


        DB::transaction(function() use($request) {
            $parent="";
            if($request->statusMenuEdit != "0") {
              $parent = $request->parentIdEdit;
            } else {
              $parent = 0;
            }

            $set = Menu::find($request->id);
            $set->id_parent = $parent;
            $set->nama_menu = $request->namaMenuEdit;
            $set->icon = $request->iconEdit;
            $set->url = $request->urlMenuEdit;
            $set->updated_by = Auth::user()->id;
            $set->save();

            $affectedRows = MasterAccess::where('id_menu', '=', $request->id)->delete();

            $dataRoles = $request->input('idroleEdit');
            // dd($dataRoles);
            foreach($dataRoles as $dataRole){
              $set = new MasterAccess;
              $set->id_menu    = $request->id;
              $set->id_role    = $dataRole;
              $set->activated  = 1;
              $set->created_by = Auth::user()->id;
              $set->save();
            }
        });

        \LogActivities::insLogActivities('log update successfully.');

        return redirect()->route('menu.index')->with('message', 'Berhasil mengubah konten menu.');
    }

    public function destroy($id, $status)
    {
        DB::transaction(function() use($id, $status) {
            $set = Menu::find($id);
            $act = "";
            if ($status == 'aktifkan') {
              $set->activated = 1;
              $act  = 1;
            } else {
              $set->activated = 0;
              $act = 0;
            }
            $set->updated_by = Auth::user()->id;
            $set->save();

            $checkChilds = Menu::where('id_parent','=' ,$id)->get();
            foreach ($checkChilds as $checkChild) {
              $set = Menu::find($checkChild->id);
              $set->activated = $act;
              $set->updated_by = Auth::user()->id;
              $set->save();
            }
        });

        \LogActivities::insLogActivities('log destroy successfully.');

        return redirect()->route('menu.index')->with('message', 'Berhasil mengubah status menu.');
    }
}
