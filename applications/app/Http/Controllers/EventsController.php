<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Image;
use Validator;
use DB;
use Alert;
use Datatables;
use Carbon\Carbon;
use PDF;
use Dompdf\Dompdf;
use App\Models\Events;
use App\Models\MasterKategori;
use App\Http\Requests;

class EventsController extends Controller
{
    public function __construct()
    {
        $this->middleware('isAdmin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
     {
         //
         return view('backend.events.index');
     }

     public function getDataForDataTable()
     {

       if (Auth::user()->id_role != 4) {
         $querys = Events::leftJoin('master_kategori','events.id_kategori','=','master_kategori.id')
             ->leftJoin('master_users','events.created_by','=','master_users.id')
             ->select(['events.id as id_events',
                       'events.judul_event', 'master_kategori.nama_kategori',
                       'events.lokasi', 'events.fasilitator',
                       'events.flag_headline', 'events.flag_publish', 'events.activated'])
                       ->orderBy('flag_publish', 'DESC')
                       ->orderBy('id_events', 'DESC');
       } else {
         $querys = Events::leftJoin('master_kategori','events.id_kategori','=','master_kategori.id')
             ->leftJoin('master_users','events.created_by','=','master_users.id')
             ->select(['events.id as id_events',
                       'events.judul_event', 'master_kategori.nama_kategori',
                       'events.lokasi', 'events.fasilitator',
                       'events.flag_headline', 'events.flag_publish', 'events.activated'])
                       ->where('events.created_by', '=', Auth::user()->id)
                       ->orderBy('flag_publish', 'DESC')
                       ->orderBy('id_events', 'DESC');
       }

                       // dd($querys);
       return Datatables::of($querys)
         ->addColumn('action', function($query){
             if ($query->flag_headline == "1") {
               $strHeadline = '<a href="#" class="btn bg-deep-purple btn-circle waves-effect waves-circle waves-float flagheadline"
                               data-toggle="modal" data-target="#modalflagheadline" data-value="'.$query->id_events.'"
                               data-backdrop="static" data-keyboard="false"><i class="material-icons">favorite</i></a>';
             } else {
               $strHeadline = '<a href="#" class="btn bg-blue-grey btn-circle waves-effect waves-circle waves-float flagheadline"
                                 data-toggle="modal" data-target="#modalflagheadline" data-value="'.$query->id_events.'"
                                 data-backdrop="static" data-keyboard="false"><i class="material-icons">favorite_border</i></a>';
             }

             if ($query->flag_publish == "1") {
               $strPublish = '<a href="#" class="btn btn-warning btn-circle waves-effect waves-circle waves-float flagpublish"
                               data-toggle="modal" data-target="#modalflagpublish" data-value="'.$query->id_events.'"
                               data-backdrop="static" data-keyboard="false"><i class="material-icons">star</i></a>';
             } else {
               $strPublish = '<a href="#" class="btn bg-blue-grey btn-circle waves-effect waves-circle waves-float flagpublish"
                                 data-toggle="modal" data-target="#modalflagpublish" data-value="'.$query->id_events.'"
                                 data-backdrop="static" data-keyboard="false"><i class="material-icons">star_border</i></a>';
             }

             if ($query->activated == "1") {
               $strDelete = '<a href="#" class="btn btn-danger btn-circle waves-effect waves-circle waves-float hapus"
                               data-toggle="modal" data-target="#modaldelete"
                               data-value="'.$query->id_events.'" data-backdrop="static"
                               data-keyboard="false"><i class="material-icons">delete_forever</i></a>';
             } else {
               $strDelete = '<a href="#" class="btn bg-blue-grey btn-circle waves-effect waves-circle waves-float aktifkan"
                               data-toggle="modal" data-target="#modalAktifkan"
                               data-value="'.$query->id_events.'" data-backdrop="static"
                               data-keyboard="false"><i class="material-icons">thumb_down</i></a>';
             }

             $strUpd = '<a href="admin/events.edit/'.$query->id_events.'" class="btn btn-success btn-circle waves-effect waves-circle waves-float">
                           <i class="material-icons">open_in_new</i></a>';

             $strView = '<a href="admin/events.view/'.$query->id_events.'" class="btn btn-primary btn-circle waves-effect waves-circle waves-float">
                           <i class="material-icons">remove_red_eye</i></a>';

             if (Auth::user()->id_role != 4) {
                   return $strHeadline.' '.$strPublish.' '.$strUpd.' '.$strDelete.' '.$strView;
             } else{
                   if ($query->flag_publish == "1") {
                     return $strView;
                   } else {
                     return $strUpd.' '.$strDelete.' '.$strView;
                   }
             }

         })
         ->editColumn('flag_headline', function($query){
           if ($query->flag_headline=="1") {
             return "<span class='badge bg-deep-purple'>Headline</span>";
           } elseif ($query->flag_headline=="0")  {
             return "<span class='badge bg-blue-grey'>Un Headline</span>";
           }
         })

         ->editColumn('flag_publish', function($query){
           if ($query->flag_publish=="1") {
             return "<span class='badge bg-orange'>Publish</span>";
           } elseif ($query->flag_publish=="0")  {
             return "<span class='badge bg-blue-grey'>Un Publish</span>";
           }
         })
         ->removeColumn('activated')
         ->removeColumn('id_events')
         ->make();
     }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function create()
     {
         //
         $getKategori = MasterKategori::where('flag_utama','=' ,'events')->get();
         return view('backend.events.tambah', compact('getKategori'));
     }

     /**
      * Store a newly created resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @return \Illuminate\Http\Response
      */
     public function store(Request $request)
     {
         //
         $messages = [
           'judul.required' => 'Tidak boleh kosong.',
           'kategoriId.required' => 'Tidak boleh kosong.',
           'tglAwal.required' => 'Tidak boleh kosong.',
           'tglAkhir.required' => 'Tidak boleh kosong.',
           'urlFoto.required' => 'Tidak boleh kosong.',
           'urlFoto.required' => 'Periksa kembali file image anda.',
           'urlFoto.image' => 'File upload harus image.',
           'urlFoto.mimes' => 'Ekstensi file tidak valid.',
           'urlFoto.max' => 'Ukuran file terlalu besar.',
           'urlScrut.required' => 'Tidak boleh kosong.',
           'urlRules.required' => 'Tidak boleh kosong.',
           'isiKonten.required' => 'Tidak boleh kosong.',
           'fasilitator.required' => 'Tidak boleh kosong.',
           'jmlPeserta.required' => 'Tidak boleh kosong.',
           'lokasi.required' => 'Tidak boleh kosong.',
           'alamat.required' => 'Tidak boleh kosong.',
           'entranceFee.required' => 'Tidak boleh kosong.',
           'shirtSizes.required' => 'Tidak boleh kosong.',
           'payment.required' => 'Tidak boleh kosong.',
           'kategoriId.not_in' => 'Pilih salah satu.',
         ];

         $validator = Validator::make($request->all(), [
                 'judul' => 'required',
                 'kategoriId' => 'required',
                 'isiKonten' => 'required',
                 'tglAwal' => 'required',
                 'tglAkhir' => 'required',
                 'fasilitator' => 'required',
                 'jmlPeserta' => 'required',
                 'lokasi' => 'required',
                 'alamat' => 'required',
                 'entranceFee' => 'required',
                 'payment' => 'required',
                 'shirtSizes' => 'required',
                 'kategoriId' => 'required|not_in:-- Pilih --',
                 'urlFoto' => 'required|image|mimes:jpeg,jpg,png|max:40000',
                 'urlScrut' => 'required',
                 'urlRules' => 'required',
             ], $messages);

         if ($validator->fails()) {
             return redirect()->route('events.tambah')->withErrors($validator)->withInput();
         }

         $file = $request->file('urlFoto');
         $fileScrut = $request->file('urlScrut');
         $fileRules = $request->file('urlRules');
         if($file!="") {
           $photoName = Auth::user()->email.'_'.time(). '.' . $file->getClientOriginalExtension();
           Image::make($file)->save('images/events/asli/'. $photoName);
           Image::make($file)->fit(555,280)->save('images/events/'. $photoName);

           $scrutName = 'scrut_'.Auth::user()->email.'_'.time(). '.' . $fileScrut->getClientOriginalExtension();
           $fileScrut->move('documents', $scrutName);

           $rulesName = 'rules_'.Auth::user()->email.'_'.time(). '.' . $fileRules->getClientOriginalExtension();
           $fileRules->move('documents', $rulesName);


           $flagHeadline="";
           if($request->flagHeadline=="") {
             $flagHeadline=0;
           } else {
             $flagHeadline=1;
           }

           $setStartDate = date("Y-m-d", strtotime($request->tglAwal));
           $setEndDate = date("Y-m-d", strtotime($request->tglAkhir));
           $set = new Events;
           $set->judul_event = $request->judul;
           $set->tanggal_mulai = $setStartDate;
           $set->tanggal_akhir = $setEndDate;
           $set->id_kategori = $request->kategoriId;
           $set->url_foto = $photoName;
           $set->url_scrut = $photoName;
           $set->url_rules = $photoName;
           $set->maps = $request->maps;
           $set->fasilitator = $request->fasilitator;
           $set->jumlah_peserta = $request->jmlPeserta;
           $set->lokasi = $request->lokasi;
           $set->alamat = $request->alamat;
           $set->shirt_sizes = $request->shirtSizes;
           $set->entrance_fee = $request->entranceFee;
           $set->payment = $request->payment;
           $set->isi_event = $request->isiKonten;
           $set->tags = $request->tags;
           $set->flag_headline = $flagHeadline;
           $set->activated = 1;
           $set->created_by = Auth::user()->id;
           $set->save();
         } else {
           return redirect()->route('events.index')->with('messagefail', 'Gambar events harus di upload.');
         }

         \LogActivities::insLogActivities('log insert successfully.');

         return redirect()->route('events.index')->with('message', 'Berhasil memasukkan events baru.');
     }

     /**
      * Display the specified resource.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function show($id)
     {
         //
         $set = Events::find($id);
         if($set->flag_publish=="1") {
           $set->flag_publish = 0;
         } elseif ($set->flag_publish=="0") {
           $set->flag_publish = 1;
         }
         $set->updated_by = Auth::user()->id;
         $set->save();

         \LogActivities::insLogActivities('log publish successfully.');

         return redirect()->route('events.index')->with('message', 'Berhasil mengubah publish events.');
     }

     public function headline($id)
     {
         //
         $set = Events::find($id);
         if($set->flag_headline=="1") {
           $set->flag_headline = 0;
         } elseif ($set->flag_headline=="0") {
           $set->flag_headline = 1;
         }
         $set->updated_by = Auth::user()->id;
         $set->save();

         \LogActivities::insLogActivities('log headline successfully.');

         return redirect()->route('events.index')->with('message', 'Berhasil mengubah headline events.');
     }

     /**
      * Show the form for editing the specified resource.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function edit($id)
     {
         //
         $editEvents = Events::find($id);

         $getKategori = MasterKategori::where('flag_utama','=' ,'events')->get();

         return view('backend/events/edit', compact('editEvents', 'getKategori'));
     }

     public function view($id)
     {
         //
         $viewEvents = Events::find($id);

         $getKategori = MasterKategori::where('flag_utama','=' ,'events')->get();

         return view('backend/events/edit', compact('viewEvents', 'getKategori'));
     }

     /**
      * Update the specified resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function update(Request $request)
     {
         //
         $messages = [
           'judul.required' => 'Tidak boleh kosong.',
           'kategoriId.required' => 'Tidak boleh kosong.',
           'tglAwal.required' => 'Tidak boleh kosong.',
           'tglAkhir.required' => 'Tidak boleh kosong.',
           // 'isiKonten.required' => 'Tidak boleh kosong.',
           'fasilitator.required' => 'Tidak boleh kosong.',
           'jmlPeserta.required' => 'Tidak boleh kosong.',
           'lokasi.required' => 'Tidak boleh kosong.',
           'alamat.required' => 'Tidak boleh kosong.',
           'shirtSizes.required' => 'Tidak boleh kosong.',
           'entranceFee.required' => 'Tidak boleh kosong.',
           'payment.required' => 'Tidak boleh kosong.',
           'kategoriId.not_in' => 'Pilih salah satu.',
         ];

         $validator = Validator::make($request->all(), [
                 'judul' => 'required',
                 'kategoriId' => 'required',
                 // 'isiKonten' => 'required',
                 'tglAwal' => 'required',
                 'tglAkhir' => 'required',
                 'fasilitator' => 'required',
                 'jmlPeserta' => 'required',
                 'lokasi' => 'required',
                 'alamat' => 'required',
                 'shirtSizes' => 'required',
                 'entranceFee' => 'required',
                 'payment' => 'required',
                 'kategoriId' => 'required|not_in:-- Pilih --',
             ], $messages);

         if ($validator->fails()) {
             return redirect()->route('events.edit', $request->id)->withErrors($validator)->withInput();
         }

         $flagHeadline="";
         if($request->flagHeadline=="") {
           $flagHeadline=0;
         } else {
           $flagHeadline=1;
         }

         $setStartDate = date("Y-m-d", strtotime($request->tglAwal));
         $setEndDate = date("Y-m-d", strtotime($request->tglAkhir));
         $setTglPosting = date('Y-m-d');
         $set = Events::find($request->id);
         $set->judul_event = $request->judul;
         $set->tanggal_mulai = $setStartDate;
         $set->tanggal_akhir = $setEndDate;
         $set->id_kategori = $request->kategoriId;
         $file = $request->file('urlFoto');
         if($file!="") {
           $photoName = Auth::user()->email.'_'.time(). '.' . $file->getClientOriginalExtension();
           Image::make($file)->save('images/events/asli/'. $photoName);
           Image::make($file)->fit(555,280)->save('images/events/'. $photoName);
           $set->url_foto = $photoName;
         }
         $fileScrut = $request->file('urlScrut');
         if($fileScrut!=null){
           $scrutName = 'scrut_'.Auth::user()->email.'_'.time(). '.' . $fileScrut->getClientOriginalExtension();
           $fileScrut->move('documents', $scrutName);
           $set->url_scrut = $scrutName;
         }

         $fileRules = $request->file('urlRules');
         if($fileRules!=null){
           $rulesName = 'rules_'.Auth::user()->email.'_'.time(). '.' . $fileRules->getClientOriginalExtension();
           $fileRules->move('documents', $rulesName);
           $set->url_rules = $rulesName;
         }

         $set->maps = $request->maps;
         $set->shirt_sizes = $request->shirtSizes;
         $set->fasilitator = $request->fasilitator;
         $set->jumlah_peserta = $request->jmlPeserta;
         $set->lokasi = $request->lokasi;
         $set->alamat = $request->alamat;
         $set->entrance_fee = $request->entranceFee;
         $set->payment = $request->payment;
         $set->isi_event = $request->isiKonten;
         $set->tags = $request->tags;
         $set->flag_headline = $flagHeadline;
         $set->activated = 1;
         $set->updated_by = Auth::user()->id;
         $set->save();

         \LogActivities::insLogActivities('log update successfully.');

         return redirect()->route('events.index')->with('message', 'Berhasil mengubah events.');
     }

     /**
      * Remove the specified resource from storage.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function destroy($id, $status)
     {
         //
         $set = Events::find($id);
         if ($status == 'aktifkan') {
           $set->activated = 1;
         } else {
           $set->activated = 0;
         }
         $set->updated_by = Auth::user()->id;
         $set->save();

         \LogActivities::insLogActivities('log destroy successfully.');

         return redirect()->route('events.index')->with('message', 'Berhasil mengubah status events.');
     }
}
