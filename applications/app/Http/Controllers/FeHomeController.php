<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Image;
use Validator;
use DB;
use App\Models\Events;
use App\Models\Informasi;
use App\Models\MasterVideo;
use App\Models\MasterSponsor;
use App\Models\MasterSlider;
use App\Models\MasterSertifikat;
use App\Models\MasterPesan;
use App\Models\MasterProduct;
use App\Http\Requests;
use Carbon\Carbon;

class FeHomeController extends Controller
{

    public function index()
    {

        $getSlider = MasterSlider::all();
        $getDataSejarah = Informasi::select('informasi.*')
                      ->where('informasi.flag_status', '=', 'profile')
                      ->where('informasi.id_kategori', '=', '5')
                      ->get();

        $dt = Carbon::now();
        $dt1 = Carbon::now()->addDays(1);
        $dt2 = Carbon::now()->addDays(2);
        $getDataEventsHeadline = Events::select('events.*')
                     ->where('events.flag_headline', '=', '1')
                     ->get();
        $getDataEventsToday = Events::select('events.*')
                     ->whereRaw('"'.$dt.'" between tanggal_mulai and tanggal_akhir')
                     ->where('events.flag_headline', '=', '1')
                     ->where('flag_publish', '1')
                     ->limit(5)
                     ->orderby('id', 'DESC')
                     ->get();
       $getDataEventsTomorrow = Events::select('events.*')
                    ->whereRaw('"'.$dt1.'" between tanggal_mulai and tanggal_akhir')
                    ->where('events.flag_headline', '=', '1')
                    ->where('flag_publish', '1')
                    ->limit(5)
                    ->orderby('id', 'DESC')
                    ->get();
        $getDataEventsEtc = Events::select('events.*')
                     ->whereRaw('"'.$dt2.'" between tanggal_mulai and tanggal_akhir')
                     ->where('events.flag_headline', '=', '1')
                     ->where('flag_publish', '1')
                     ->limit(5)
                     ->orderby('id', 'DESC')
                     ->get();
                     // dd($getDataEvents);
        $getSponsor = MasterSponsor::select('master_sponsor.*')
                      ->where('flag_sponsor', 1)
                      ->orderby('id', 'DESC')
                      ->get();
        $getProduct = MasterProduct::select('master_product.*')
                      ->where('flag_product', 1)
                      ->orderby('id', 'DESC')
                      ->get();
        $getSertifikatPortrait = MasterSertifikat::select('master_sertifikat.*')
                      ->where('flag_sertifikat', 1)
                      ->where('format_sertifikat', 'P')
                      ->orderby('id', 'ASC')
                      ->get();
        $getSertifikatLandscape = MasterSertifikat::select('master_sertifikat.*')
                      ->where('flag_sertifikat', 1)
                      ->where('format_sertifikat', 'L')
                      ->orderby('id', 'ASC')
                      ->get();
        $getDataPesan = MasterPesan::select('*')
                     ->where('flag_pesan', 1)
                     ->limit(10)
                     // ->orderby(DB::raw('rand()'))
                     ->orderby('id', 'DESC')
                     ->get();
        $getDataArticle = Informasi::leftJoin('master_users','informasi.created_by','=','master_users.id')
                      ->select('informasi.*', 'master_users.name', 'master_users.fullname', 'master_users.email', 'master_users.url_foto as url_foto2')
                      ->where('informasi.flag_status', '=', 'article')
                      ->where('informasi.flag_headline', '=', '1')
                      ->where('informasi.flag_publish', '=', '1')
                      ->limit(3)
                      ->orderby('view_counter','DESC')
                      ->get();

        return view('frontend.home.home', compact('getDataEventsHeadline', 'getSlider','getDataSejarah','getDataEventsToday'
                                                  ,'getDataEventsTomorrow','getDataEventsEtc'
                                                  ,'getSertifikatLandscape','getSertifikatPortrait'
                                                  ,'getSponsor','getProduct','getDataArticle'
                                                  ,'getDataPesan'));
    }

    public function storeContact(Request $request)
    {
      // dd($request->all());
          $messages = [
            'email.required' => 'Tidak boleh kosong.',
            'nama.required' => 'Tidak boleh kosong.',
            'subject.required' => 'Tidak boleh kosong.',
            'message.required' => 'Tidak boleh kosong.',
            'telephone.required' => 'Tidak boleh kosong.',
          ];

          $validator = Validator::make($request->all(), [
                  'email' => 'required',
                  'nama' => 'required',
                  'subject' => 'required',
                  'message' => 'required',
                  'telephone' => 'required',
              ], $messages);

          if ($validator->fails()) {
              return redirect()->route('home')->withErrors($validator)->withInput();
          }

          $set = new MasterPesan;
          $set->email = $request->email;
          $set->nama = $request->nama;
          $set->subject = $request->subject;
          $set->telepon = $request->telephone;
          $set->isi = $request->message;
          $set->flag_pesan = 0;
          $set->activated = 1;
          $set->created_by = $request->email;
          $set->save();

          // \LogActivities::insLogActivities('log insert successfully.');

          return redirect()->route('home')->with('message', 'Berhasil memasukkan pesan anda.');
    }

}
