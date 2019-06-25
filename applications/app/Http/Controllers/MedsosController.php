<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Image;
use Validator;
use DB;
use App\Models\MasterMedsos;
use App\Http\Requests;

class MedsosController extends Controller
{

    public function __construct()
    {
        $this->middleware('isAdmin');
    }

    public function index()
    {
        //
        $getMedsos = MasterMedsos::select('*')->orderby('id', 'desc')->get();
        return view('backend.medsos.kelolamedsos', compact('getMedsos'));
    }


    public function store(Request $request)
    {
      // dd($request->all());
          // $messages = [
          //   'namaSosmed.required' => 'Tidak boleh kosong.',
          //   'linkSosmed.required' => 'Tidak boleh kosong.',
          //   'activated.required' => 'Tidak boleh kosong.',
          // ];
          //
          // $validator = Validator::make($request->all(), [
          //         'namaSosmed' => 'required',
          //         'linkSosmed' => 'required',
          //         'activated' => 'required',
          //     ], $messages);
          //
          // if ($validator->fails()) {
          //     return redirect()->route('medsos.index')->withErrors($validator)->withInput();
          // }

          // $checkdouble = MasterMedsos::where('nama_sosmed','=' ,$request->namaSosmed)->get();
          //
          // if ($checkdouble != null) {
          //   return redirect()->route('medsos.index')->with('messagefail', 'Media sosial sudah tersedia.');
          // }

          $set = new MasterMedsos;
          $set->nama_sosmed = $request->namaSosmed;
          $set->link_sosmed = $request->linkSosmed;
          $set->activated = $request->activated;
          $set->created_by = Auth::user()->id;
          $set->save();

          \LogActivities::insLogActivities('log insert successfully.');

          return redirect()->route('medsos.index')->with('message', 'Berhasil memasukkan medsos baru.');
    }


    public function edit($id)
    {
        $get = MasterMedsos::find($id);
        return $get;
    }

    public function update(Request $request)
    {
        // dd($request->all());
        // $messages = [
        //   'id.required' => 'Tidak boleh kosong.',
        //   'linkSosmedEdit.required' => 'Tidak boleh kosong.',
        // ];
        //
        // $validator = Validator::make($request->all(), [
        //         'id' => 'required',
        //         'linkSosmedEdit' => 'required',
        //     ], $messages);
        //
        // if ($validator->fails()) {
        //   // dd($validator);
        //     return redirect()->route('medsos.index')->withErrors($validator)->withInput();
        // }

        $set = MasterMedsos::find($request->id);
        $set->link_sosmed = $request->linkSosmedEdit;
        $set->updated_by = Auth::user()->id;
        $set->save();

        \LogActivities::insLogActivities('log update successfully.');

        return redirect()->route('medsos.index')->with('message', 'Berhasil mengubah konten medsos.');
    }

    public function destroy($id, $status)
    {
        $set = MasterMedsos::find($id);
        if ($status == 'aktifkan') {
          $set->activated = 1;
        } else {
          $set->activated = 0;
        }
        $set->updated_by = Auth::user()->id;
        $set->save();

        \LogActivities::insLogActivities('log destroy successfully.');

        return redirect()->route('medsos.index')->with('message', 'Berhasil mengubah status medsos.');
    }
}
