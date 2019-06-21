<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Image;
use Validator;
use DB;
use App\Models\MasterSertifikat;
use App\Http\Requests;


class SertifikatController extends Controller
{

    public function __construct()
    {
        $this->middleware('isAdmin');
    }

    public function index()
    {
        //
        $getSertifikat = MasterSertifikat::all();
        return view('backend.sertifikat.kelolasertifikat', compact('getSertifikat'));
    }


    public function store(Request $request)
    {
      // dd($request->all());
          $messages = [
            'namaSertifikat.required' => 'Tidak boleh kosong.',
            'urlSertifikat.required' => 'Tidak boleh kosong.',
            'urlSertifikat.required' => 'Periksa kembali file image anda.',
            'urlSertifikat.image' => 'File upload harus image.',
            'urlSertifikat.mimes' => 'Ekstensi file tidak valid.',
            'urlSertifikat.max' => 'Ukuran file terlalu besar.',
            'keteranganSertifikat.required' => 'Tidak boleh kosong.',
            'format.required' => 'Tidak boleh kosong.',
            'activated.required' => 'Tidak boleh kosong.',
          ];

          $validator = Validator::make($request->all(), [
                  'namaSertifikat' => 'required',
                  'keteranganSertifikat' => 'required',
                  'format' => 'required',
                  'activated' => 'required',
                  'urlSertifikat' => 'required|image|mimes:jpeg,jpg,png|max:20000',
              ], $messages);

          if ($validator->fails()) {
              return redirect()->route('sertifikat.index')->withErrors($validator)->withInput();
          }

          $file = $request->file('urlSertifikat');
          if($file!="") {
              $photoName = Auth::user()->email.'_'.time(). '.' . $file->getClientOriginalExtension();
              Image::make($file)->save('images/sertifikat/'. $photoName);

              $set = new MasterSertifikat;
              $set->nama_sertifikat = $request->namaSertifikat;
              $set->url_sertifikat = $photoName;
              $set->format_sertifikat = $request->format;
              $set->keterangan_sertifikat = $request->keteranganSertifikat;
              $set->flag_sertifikat = 1;
              $set->activated = $request->activated;
              $set->created_by = Auth::user()->id;
              $set->save();
          } else {
            return redirect()->route('sertifikat.index')->with('messagefail', 'Gambar sertifikat harus di upload.');
          }

          \LogActivities::insLogActivities('log insert successfully.');

          return redirect()->route('sertifikat.index')->with('message', 'Berhasil memasukkan sertifikat baru.');
    }

    public function show($id)
    {
        $set = MasterSertifikat::find($id);
        if($set->flag_sertifikat=="1") {
          $set->flag_sertifikat = 0;
        } elseif ($set->flag_sertifikat=="0") {
          $set->flag_sertifikat = 1;
        }
        $set->updated_by = Auth::user()->id;
        $set->save();

        \LogActivities::insLogActivities('log publish successfully.');

        return redirect()->route('sertifikat.index')->with('message', 'Berhasil mengubah publish sertifikat.');
    }

    public function edit($id)
    {
        $get = MasterSertifikat::find($id);
        return $get;
    }

    public function update(Request $request)
    {
        // dd($request->all());
        $messages = [
          'id.required' => 'Tidak boleh kosong.',
          'namaSertifikatEdit.required' => 'Tidak boleh kosong.',
          'keteranganSertifikatEdit.required' => 'Tidak boleh kosong.',
          // 'formatEdit.required' => 'Tidak boleh kosong.',
        ];

        $validator = Validator::make($request->all(), [
                'id' => 'required',
                'namaSertifikatEdit' => 'required',
                'keteranganSertifikatEdit' => 'required',
                // 'formatEdit' => 'required',
            ], $messages);

        if ($validator->fails()) {
          // dd($validator);
            return redirect()->route('sertifikat.index')->withErrors($validator)->withInput();
        }

        $set = MasterSertifikat::find($request->id);
        $set->nama_sertifikat = $request->namaSertifikatEdit;
        $file = $request->file('urlSertifikat');
        if($file!="") {
          $photoName = Auth::user()->email.'_'.time(). '.' . $file->getClientOriginalExtension();
          Image::make($file)->save('images/sertifikat/'. $photoName);
          $set->url_sertifikat = $photoName;
        }
        $set->keterangan_sertifikat = $request->keteranganSertifikatEdit;
        $set->updated_by = Auth::user()->id;
        $set->save();

        \LogActivities::insLogActivities('log update successfully.');

        return redirect()->route('sertifikat.index')->with('message', 'Berhasil mengubah konten sertifikat.');
    }

    public function destroy($id, $status)
    {
        $set = MasterSertifikat::find($id);
        if ($status == 'aktifkan') {
          $set->activated = 1;
        } else {
          $set->activated = 0;
        }
        $set->updated_by = Auth::user()->id;
        $set->save();

        \LogActivities::insLogActivities('log destroy successfully.');

        return redirect()->route('sertifikat.index')->with('message', 'Berhasil mengubah status sertifikat.');
    }
}
