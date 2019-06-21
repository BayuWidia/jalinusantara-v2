<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Image;
use Validator;
use DB;
use App\Models\MasterRoles;
use App\Http\Requests;

class RoleController extends Controller
{

    public function __construct()
    {
        $this->middleware('isAdmin');
    }

    public function index()
    {
        //
        $getRole = MasterRoles::all();
        return view('backend.role.kelolarole', compact('getRole'));
    }


    public function store(Request $request)
    {
      // dd($request->all());
          $messages = [
            'namaRole.required' => 'Tidak boleh kosong.',
            'keteranganRole.required' => 'Tidak boleh kosong.',
            'activated.required' => 'Tidak boleh kosong.',
          ];

          $validator = Validator::make($request->all(), [
                  'namaRole' => 'required',
                  'keteranganRole' => 'required',
                  'activated' => 'required',
              ], $messages);

          if ($validator->fails()) {
              return redirect()->route('role.index')->withErrors($validator)->withInput();
          }

          $checkdouble = MasterRoles::where('nama_role','=' ,$request->namaRole)->get();

          if ($checkdouble != null) {
            return redirect()->route('role.index')->with('messagefail', 'Role name sudah tersedia.');
          }

          $set = new MasterRoles;
          $set->nama_role = $request->namaRole;
          $set->keterangan = $request->keteranganRole;
          $set->activated = $request->activated;
          $set->created_by = Auth::user()->id;
          $set->save();

          \LogActivities::insLogActivities('log insert successfully.');

          return redirect()->route('role.index')->with('message', 'Berhasil memasukkan role baru.');
    }


    public function edit($id)
    {
        $get = MasterRoles::find($id);
        return $get;
    }

    public function update(Request $request)
    {
        // dd($request->all());
        $messages = [
          'id.required' => 'Tidak boleh kosong.',
          'namaRoleEdit.required' => 'Tidak boleh kosong.',
          'keteranganRoleEdit.required' => 'Tidak boleh kosong.',
        ];

        $validator = Validator::make($request->all(), [
                'id' => 'required',
                'namaRoleEdit' => 'required',
                'keteranganRoleEdit' => 'required',
            ], $messages);

        if ($validator->fails()) {
          // dd($validator);
            return redirect()->route('role.index')->withErrors($validator)->withInput();
        }

        $set = MasterRoles::find($request->id);
        $set->nama_role = $request->namaRoleEdit;
        $set->keterangan = $request->keteranganRoleEdit;
        $set->updated_by = Auth::user()->id;
        $set->save();

        \LogActivities::insLogActivities('log update successfully.');

        return redirect()->route('role.index')->with('message', 'Berhasil mengubah konten role.');
    }

    public function destroy($id, $status)
    {
        $set = MasterRoles::find($id);
        if ($status == 'aktifkan') {
          $set->activated = 1;
        } else {
          $set->activated = 0;
        }
        $set->updated_by = Auth::user()->id;
        $set->save();

        \LogActivities::insLogActivities('log destroy successfully.');

        return redirect()->route('role.index')->with('message', 'Berhasil mengubah status role.');
    }
}
