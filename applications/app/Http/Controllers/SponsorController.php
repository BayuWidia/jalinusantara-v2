<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Image;
use Validator;
use DB;
use App\Models\MasterSponsor;
use App\Http\Requests;


class SponsorController extends Controller
{

    public function __construct()
    {
        $this->middleware('isAdmin');
    }

    public function index()
    {
        //
        $getSponsor = MasterSponsor::all();
        return view('backend.sponsor.kelolasponsor', compact('getSponsor'));
    }


    public function store(Request $request)
    {
      // dd($request->all());
          $messages = [
            'namaSponsor.required' => 'Tidak boleh kosong.',
            'linkSponsor.required' => 'Tidak boleh kosong.',
            'urlSponsor.required' => 'Tidak boleh kosong.',
            'urlSponsor.required' => 'Periksa kembali file image anda.',
            'urlSponsor.image' => 'File upload harus image.',
            'urlSponsor.mimes' => 'Ekstensi file tidak valid.',
            'urlSponsor.max' => 'Ukuran file terlalu besar.',
            'keteranganSponsor.required' => 'Tidak boleh kosong.',
            'rekomendasi.required' => 'Tidak boleh kosong.',
            'activated.required' => 'Tidak boleh kosong.',
          ];

          $validator = Validator::make($request->all(), [
                  'namaSponsor' => 'required',
                  'linkSponsor' => 'required',
                  'keteranganSponsor' => 'required',
                  'rekomendasi' => 'required',
                  'activated' => 'required',
                  'urlSponsor' => 'required|image|mimes:jpeg,jpg,png|max:20000',
              ], $messages);

          if ($validator->fails()) {
              return redirect()->route('sponsor.index')->withErrors($validator)->withInput();
          }

          $file = $request->file('urlSponsor');
          if($file!="") {
              $photoName = Auth::user()->email.'_'.time(). '.' . $file->getClientOriginalExtension();
              Image::make($file)->save('images/sponsor/asli/'. $photoName);
              Image::make($file)->fit(188,126)->save('images/sponsor/'. $photoName);

              $set = new MasterSponsor;
              $set->nama_sponsor = $request->namaSponsor;
              $set->link_sponsor = $request->linkSponsor;
              $set->url_sponsor = $photoName;
              $set->keterangan_sponsor = $request->keteranganSponsor;
              $set->rekomendasi = $request->rekomendasi;
              $set->flag_sponsor = 1;
              $set->activated = $request->activated;
              $set->created_by = Auth::user()->id;
              $set->save();
          } else {
            return redirect()->route('sponsor.index')->with('messagefail', 'Gambar sponsor harus di upload.');
          }

          \LogActivities::insLogActivities('log insert successfully.');

          return redirect()->route('sponsor.index')->with('message', 'Berhasil memasukkan sponsor baru.');
    }

    public function show($id)
    {
        $set = MasterSponsor::find($id);
        if($set->flag_sponsor=="1") {
          $set->flag_sponsor = 0;
        } elseif ($set->flag_sponsor=="0") {
          $set->flag_sponsor = 1;
        }
        $set->updated_by = Auth::user()->id;
        $set->save();

        \LogActivities::insLogActivities('log publish successfully.');

        return redirect()->route('sponsor.index')->with('message', 'Berhasil mengubah publish sponsor.');
    }

    public function edit($id)
    {
        $get = MasterSponsor::find($id);
        return $get;
    }

    public function update(Request $request)
    {
        // dd($request->all());
        $messages = [
          'id.required' => 'Tidak boleh kosong.',
          'namaSponsorEdit.required' => 'Tidak boleh kosong.',
          'linkSponsorEdit.required' => 'Tidak boleh kosong.',
          'keteranganSponsorEdit.required' => 'Tidak boleh kosong.',
          'rekomendasiEdit.required' => 'Tidak boleh kosong.',
        ];

        $validator = Validator::make($request->all(), [
                'id' => 'required',
                'namaSponsorEdit' => 'required',
                'linkSponsorEdit' => 'required',
                'keteranganSponsorEdit' => 'required',
                'rekomendasiEdit' => 'required',
            ], $messages);

        if ($validator->fails()) {
          // dd($validator);
            return redirect()->route('sponsor.index')->withErrors($validator)->withInput();
        }

        $set = MasterSponsor::find($request->id);
        $set->nama_sponsor = $request->namaSponsorEdit;
        $set->link_sponsor = $request->linkSponsorEdit;
        $file = $request->file('urlSponsor');
        if($file!="") {
          $photoName = Auth::user()->email.'_'.time(). '.' . $file->getClientOriginalExtension();
          Image::make($file)->save('images/sponsor/asli/'. $photoName);
          Image::make($file)->fit(188,126)->save('images/sponsor/'. $photoName);
          $set->url_sponsor = $photoName;
        }
        $set->keterangan_sponsor = $request->keteranganSponsorEdit;
        $set->rekomendasi = $request->rekomendasiEdit;
        $set->updated_by = Auth::user()->id;
        $set->save();

        \LogActivities::insLogActivities('log update successfully.');

        return redirect()->route('sponsor.index')->with('message', 'Berhasil mengubah konten sponsor.');
    }

    public function destroy($id, $status)
    {
        $set = MasterSponsor::find($id);
        if ($status == 'aktifkan') {
          $set->activated = 1;
        } else {
          $set->activated = 0;
        }
        $set->updated_by = Auth::user()->id;
        $set->save();

        \LogActivities::insLogActivities('log destroy successfully.');

        return redirect()->route('sponsor.index')->with('message', 'Berhasil mengubah status sponsor.');
    }
}
