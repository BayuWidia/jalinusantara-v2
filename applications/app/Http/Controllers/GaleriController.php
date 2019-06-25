<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Image;
use Validator;
use DB;
use App\Models\MasterGaleri;
use App\Models\Events;
use App\Http\Requests;

class GaleriController extends Controller
{
    public function __construct()
    {
        $this->middleware('isAdmin');
    }

    public function index()
    {
          $getDataEvents = Events::leftJoin('master_kategori','events.id_kategori','=','master_kategori.id')
              ->select(['events.*','master_kategori.nama_kategori'])
                      ->orderBy('nama_kategori', 'ASC')
                      ->orderBy('judul_event', 'ASC')->get();
          $getGaleri = MasterGaleri::leftJoin('events','master_galeri.id_events','=','events.id')
              ->select(['master_galeri.*','events.judul_event'])
                      ->orderBy('master_galeri.d', 'DESC')->get();

          return view('backend.galeri.kelolagaleri', compact('getGaleri','getDataEvents'));
    }

    public function store(Request $request)
    {
      // dd($request->all());
          // $messages = [
          //   'eventsId.required' => 'Tidak boleh kosong.',
          //   'judul.required' => 'Tidak boleh kosong.',
          //   'urlGaleri.*.required' => 'Tidak boleh kosong.',
          //   'urlGaleri.*.required' => 'Periksa kembali file image anda.',
          //   'urlGaleri.*.image' => 'File upload harus image.',
          //   'urlGaleri.*.mimes' => 'Ekstensi file tidak valid.',
          //   'urlGaleri.*.max' => 'Ukuran file terlalu besar.',
          //   'keteranganGaleri.required' => 'Tidak boleh kosong.',
          //   'activated.required' => 'Tidak boleh kosong.',
          // ];
          //
          // $validator = Validator::make($request->all(), [
          //         'eventsId' => 'required',
          //         'judul' => 'required',
          //         'keteranganGaleri' => 'required',
          //         'activated' => 'required',
          //         'urlGaleri.*' => 'required|image|mimes:jpeg,jpg,png|max:20000',
          //     ], $messages);
          //
          // if ($validator->fails()) {
          //     return redirect()->route('galeri.index')->withErrors($validator)->withInput();
          // }

          DB::transaction(function() use($request) {
              $dataItems = $request->data_item;
                foreach($dataItems as $dataItem){
                  // $file = $request->file($dataItem['urlGaleri']);
                  $file = $dataItem['urlGaleri'];
                  $photoName = Auth::user()->email.'_'.rand(). '.' . $file->getClientOriginalExtension();
                  Image::make($file)->save('images/galeri/asli/'. $photoName);
                  Image::make($file)->fit(457,250)->save('images/galeri/'. $photoName);
                  Image::make($file)->fit(200,122)->save('_thumbs/galeri/'. $photoName);

                  $set = new MasterGaleri;
                  $set->id_events = $request->eventsId;
                  $set->judul = $request->judul;
                  $set->url_gambar = $photoName;
                  $set->keterangan_gambar = $request->keteranganGaleri;
                  $set->flag_gambar = 1;
                  $set->activated = $request->activated;
                  $set->created_by = Auth::user()->id;
                  $set->save();

                }
          });

          \LogActivities::insLogActivities('log insert successfully.');

          return redirect()->route('galeri.index')->with('message', 'Berhasil memasukkan galeri baru.');
    }

    public function show($id)
    {
        $set = MasterGaleri::find($id);
        if($set->flag_gambar=="1") {
          $set->flag_gambar = 0;
        } elseif ($set->flag_gambar=="0") {
          $set->flag_gambar = 1;
        }
        $set->updated_by = Auth::user()->id;
        $set->save();

        \LogActivities::insLogActivities('log publish successfully.');

        return redirect()->route('galeri.index')->with('message', 'Berhasil mengubah publish galeri.');
    }

    public function edit($id)
    {
        $get = MasterGaleri::find($id);
        return $get;
    }

    public function update(Request $request)
    {
        // dd($request);
        // $messages = [
        //   'id.required' => 'Tidak boleh kosong.',
        //   'eventsIdEdit.required' => 'Tidak boleh kosong.',
        //   'judulEdit.required' => 'Tidak boleh kosong.',
        //   'keteranganGaleriEdit.required' => 'Tidak boleh kosong.',
        // ];
        //
        // $validator = Validator::make($request->all(), [
        //         'id' => 'required',
        //         'eventsIdEdit' => 'required',
        //         'judulEdit' => 'required',
        //         'keteranganGaleriEdit' => 'required',
        //     ], $messages);
        //
        // if ($validator->fails()) {
        //   // dd($validator);
        //     return redirect()->route('galeri.index')->withErrors($validator)->withInput();
        // }

        $set = MasterGaleri::find($request->id);
        $set->id_events = $request->eventsIdEdit;
        $set->judul = $request->judulEdit;
        $file = $request->file('urlGaleriEdit');
        if($file!="") {
          $photoName = Auth::user()->email.'_'.time(). '.' . $file->getClientOriginalExtension();
          Image::make($file)->save('images/galeri/asli/'. $photoName);
          Image::make($file)->fit(457,250)->save('images/galeri/'. $photoName);
          Image::make($file)->fit(200,122)->save('_thumbs/galeri/'. $photoName);
          $set->url_gambar = $photoName;
        }
        $set->keterangan_gambar = $request->keteranganGaleriEdit;
        $set->updated_by = Auth::user()->id;
        $set->save();

        \LogActivities::insLogActivities('log update successfully.');

        return redirect()->route('galeri.index')->with('message', 'Berhasil mengubah konten galeri.');
    }

    public function destroy($id, $status)
    {
        $set = MasterGaleri::find($id);
        if ($status == 'aktifkan') {
          $set->activated = 1;
        } else {
          $set->activated = 0;
        }
        $set->updated_by = Auth::user()->id;
        $set->save();

        \LogActivities::insLogActivities('log destroy successfully.');

        return redirect()->route('galeri.index')->with('message', 'Berhasil mengubah status galeri.');
    }
}
