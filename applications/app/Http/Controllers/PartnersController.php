<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Image;
use Validator;
use DB;
use App\Models\MasterPartners;
use App\Http\Requests;


class PartnersController extends Controller
{

    public function __construct()
    {
        $this->middleware('isAdmin');
    }

    public function index()
    {
        //
        $getPartners = MasterPartners::all();
        return view('backend.partners.kelolapartners', compact('getPartners'));
    }


    public function store(Request $request)
    {
      // dd($request->all());
          $messages = [
            'namaPartners.required' => 'Tidak boleh kosong.',
            'linkPartners.required' => 'Tidak boleh kosong.',
            'urlPartners.required' => 'Tidak boleh kosong.',
            'urlPartners.required' => 'Periksa kembali file image anda.',
            'urlPartners.image' => 'File upload harus image.',
            'urlPartners.mimes' => 'Ekstensi file tidak valid.',
            'urlPartners.max' => 'Ukuran file terlalu besar.',
            'keteranganPartners.required' => 'Tidak boleh kosong.',
            'activated.required' => 'Tidak boleh kosong.',
          ];

          $validator = Validator::make($request->all(), [
                  'namaPartners' => 'required',
                  'linkPartners' => 'required',
                  'keteranganPartners' => 'required',
                  'activated' => 'required',
                  'urlPartners' => 'required|image|mimes:jpeg,jpg,png|max:20000',
              ], $messages);

          if ($validator->fails()) {
              return redirect()->route('partners.index')->withErrors($validator)->withInput();
          }

          $file = $request->file('urlPartners');
          if($file!="") {
              $photoName = Auth::user()->email.'_'.time(). '.' . $file->getClientOriginalExtension();
              Image::make($file)->save('images/partners/asli/'. $photoName);
              Image::make($file)->fit(457,250)->save('images/partners/'. $photoName);

              $set = new MasterPartners;
              $set->nama_partners = $request->namaPartners;
              $set->link_partners = $request->linkPartners;
              $set->url_partners = $photoName;
              $set->keterangan_partners = $request->keteranganPartners;
              $set->flag_partners = 1;
              $set->activated = $request->activated;
              $set->created_by = Auth::user()->id;
              $set->save();
          } else {
            return redirect()->route('partners.index')->with('messagefail', 'Gambar Partners harus di upload.');
          }

          \LogActivities::insLogActivities('log insert successfully.');

          return redirect()->route('partners.index')->with('message', 'Berhasil memasukkan Partners baru.');
    }

    public function show($id)
    {
        $set = MasterPartners::find($id);
        if($set->flag_partners=="1") {
          $set->flag_partners = 0;
        } elseif ($set->flag_partners=="0") {
          $set->flag_partners = 1;
        }
        $set->updated_by = Auth::user()->id;
        $set->save();

        \LogActivities::insLogActivities('log publish successfully.');

        return redirect()->route('partners.index')->with('message', 'Berhasil mengubah publish Partners.');
    }

    public function edit($id)
    {
        $get = MasterPartners::find($id);
        return $get;
    }

    public function update(Request $request)
    {
        // dd($request->all());
        $messages = [
          'id.required' => 'Tidak boleh kosong.',
          'namaPartnersEdit.required' => 'Tidak boleh kosong.',
          'linkPartnersEdit.required' => 'Tidak boleh kosong.',
          'keteranganPartnersEdit.required' => 'Tidak boleh kosong.',
        ];

        $validator = Validator::make($request->all(), [
                'id' => 'required',
                'namaPartnersEdit' => 'required',
                'linkPartnersEdit' => 'required',
                'keteranganPartnersEdit' => 'required',
            ], $messages);

        if ($validator->fails()) {
          // dd($validator);
            return redirect()->route('partners.index')->withErrors($validator)->withInput();
        }

        $set = MasterPartners::find($request->id);
        $set->nama_partners = $request->namaPartnersEdit;
        $set->link_partners = $request->linkPartnersEdit;
        $file = $request->file('urlPartners');
        if($file!="") {
          $photoName = Auth::user()->email.'_'.time(). '.' . $file->getClientOriginalExtension();
          Image::make($file)->save('images/partners/asli/'. $photoName);
          Image::make($file)->fit(457,250)->save('images/partners/'. $photoName);
          $set->url_partners = $photoName;
        }
        $set->keterangan_partners = $request->keteranganPartnersEdit;
        $set->updated_by = Auth::user()->id;
        $set->save();

        \LogActivities::insLogActivities('log update successfully.');

        return redirect()->route('partners.index')->with('message', 'Berhasil mengubah konten Partners.');
    }

    public function destroy($id, $status)
    {
        $set = MasterPartners::find($id);
        if ($status == 'aktifkan') {
          $set->activated = 1;
        } else {
          $set->activated = 0;
        }
        $set->updated_by = Auth::user()->id;
        $set->save();

        \LogActivities::insLogActivities('log destroy successfully.');

        return redirect()->route('partners.index')->with('message', 'Berhasil mengubah status Partners.');
    }
}
