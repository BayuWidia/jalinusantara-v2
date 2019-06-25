<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Image;
use Validator;
use DB;
use App\Models\MasterKategori;
use App\Http\Requests;

class KategoriController extends Controller
{

    public function __construct()
    {
        $this->middleware('isAdmin');
    }

    public function index($getParams)
    {
        if ($getParams == 'profile') {
          // code...
          $getKategori = MasterKategori::where('flag_utama','=' ,'profile')->get();
        } else if ($getParams == 'article'){
          // code...
          $getKategori = MasterKategori::where('flag_utama','=' ,'article')->get();
        } else if ($getParams == 'events'){
          // code...
          $getKategori = MasterKategori::where('flag_utama','=' ,'events')->get();
        }
        return view('backend.kategori.kelolakategori', compact('getKategori', 'getParams'));
    }


    public function store(Request $request)
    {
      // dd($request->all());
          // $messages = [
          //   'namaKategori.required' => 'Tidak boleh kosong.',
          //   'keteranganKategori.required' => 'Tidak boleh kosong.',
          //   'activated.required' => 'Tidak boleh kosong.',
          // ];
          //
          // $validator = Validator::make($request->all(), [
          //         'namaKategori' => 'required',
          //         'keteranganKategori' => 'required',
          //         'activated' => 'required',
          //     ], $messages);
          //
          // if ($validator->fails()) {
          //     return redirect()->route('kategori.index',$request->flagUtama)->withErrors($validator)->withInput();
          // }

          $set = new MasterKategori;
          $set->nama_kategori = $request->namaKategori;
          $set->keterangan_kategori = $request->keteranganKategori;
          $set->flag_utama = $request->flagUtama;
          $set->activated = $request->activated;
          $set->created_by = Auth::user()->id;
          $set->save();

          \LogActivities::insLogActivities('log insert successfully.');

          return redirect()->route('kategori.index',$request->flagUtama)->with('message', 'Berhasil memasukkan kategori baru.');
    }


    public function edit($id)
    {
        $get = MasterKategori::find($id);
        return $get;
    }

    public function update(Request $request)
    {
        // dd($request->all());
        // $messages = [
        //   'id.required' => 'Tidak boleh kosong.',
        //   'namaKategoriEdit.required' => 'Tidak boleh kosong.',
        //   'keteranganKategoriEdit.required' => 'Tidak boleh kosong.',
        // ];
        //
        // $validator = Validator::make($request->all(), [
        //         'id' => 'required',
        //         'namaKategoriEdit' => 'required',
        //         'keteranganKategoriEdit' => 'required',
        //     ], $messages);
        //
        // if ($validator->fails()) {
        //   // dd($validator);
        //     return redirect()->route('kategori.index',$request->flagUtamaEdit)->withErrors($validator)->withInput();
        // }

        $set = MasterKategori::find($request->id);
        $set->nama_kategori = $request->namaKategoriEdit;
        $set->keterangan_kategori = $request->keteranganKategoriEdit;
        $set->updated_by = Auth::user()->id;
        $set->save();

        \LogActivities::insLogActivities('log update successfully.');

        return redirect()->route('kategori.index',$request->flagUtamaEdit)->with('message', 'Berhasil mengubah kategori.');
    }

    public function destroy($id, $status, $flag)
    {
        $set = MasterKategori::find($id);
        if ($status == 'aktifkan') {
          $set->activated = 1;
        } else {
          $set->activated = 0;
        }
        $set->updated_by = Auth::user()->id;
        $set->save();

        \LogActivities::insLogActivities('log destroy successfully.');

        return redirect()->route('kategori.index',$flag)->with('message', 'Berhasil mengubah status kategori.');
    }
}
