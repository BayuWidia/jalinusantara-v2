<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Image;
use Validator;
use DB;
use App\Models\Events;
use App\Models\RegistrasiEvents;
use App\Models\Mekanik;
use App\Models\Kendaraan;
use App\Models\Keluarga;
use App\Http\Requests;


class RegistrasiController extends Controller
{

    public function __construct()
    {
        $this->middleware('isAdmin');
    }

    public function index()
    {
        //
        // $getRegistrasiEvents = RegistrasiEvents::all();
        $getRegistrasiEvents = RegistrasiEvents::
          select('registrasi_events.*', 'events.judul_event')
          ->leftjoin('events', 'registrasi_events.id_events', '=', 'events.id')
          ->orderby('registrasi_events.created_at', 'desc')
          ->get();
        return view('backend.registrasi.kelolaregistrasi', compact('getRegistrasiEvents'));
    }

    public function edit($id)
    {
      // dd("asdasd");
        $dataEvents =  RegistrasiEvents::Join('events','registrasi_events.id_events','=','events.id')
            ->select('events.*')
            ->where('registrasi_events.id','=',$id)->get();
        $editRegistrasi = RegistrasiEvents::find($id);

        $getDataMekanik = Mekanik::where('id_registrasi','=' ,$id)->get();
        $getDataKendaraan = Kendaraan::where('id_registrasi','=' ,$id)->get();
        $getDataKeluarga = Keluarga::where('id_registrasi','=' ,$id)->get();

        return view('backend/registrasi/edit', compact('dataEvents'
                                                        , 'editRegistrasi'
                                                        , 'getDataMekanik'
                                                        , 'getDataKendaraan'
                                                        , 'getDataKeluarga'));
    }

    public function approve($id)
    {
        //
        $set = RegistrasiEvents::find($id);
        if($set->flag_approve=="1") {
          $set->flag_approve = 0;
        } elseif ($set->flag_approve=="0") {
          $set->flag_approve = 1;
        }
        $set->updated_by = Auth::user()->id;
        $set->save();

        \LogActivities::insLogActivities('log publish successfully.');

        return redirect()->route('registrasi.index')->with('message', 'Berhasil mengapprove data ini.');
    }

    public function update(Request $request)
    {
        // dd($request->all());
        $messages = [
          'id.required' => 'Tidak boleh kosong.',
          'nomorPintu.required' => 'Tidak boleh kosong.',
        ];

        $validator = Validator::make($request->all(), [
                'id' => 'required',
                'nomorPintu' => 'required',
            ], $messages);

        if ($validator->fails()) {
          // dd($validator);
            return redirect()->route('registrasi.edit', $request->id)->withErrors($validator)->withInput();
        }

        $set = RegistrasiEvents::find($request->id);
        $set->nomor_pintu = $request->nomorPintu;
        $set->flag_approve = 1;
        $set->updated_by = Auth::user()->id;
        $set->save();

        \LogActivities::insLogActivities('log update successfully.');

        return redirect()->route('registrasi.index')->with('message', 'Berhasil mengubah konten registrasi.');
    }

    public function destroy($id, $status)
    {
        $set = RegistrasiEvents::find($id);
        if ($status == 'aktifkan') {
          $set->activated = 1;
        } else {
          $set->activated = 0;
        }
        $set->updated_by = Auth::user()->id;
        $set->save();

        \LogActivities::insLogActivities('log destroy successfully.');

        return redirect()->route('registrasi.index')->with('message', 'Berhasil mengubah status registrasi.');
    }
}
