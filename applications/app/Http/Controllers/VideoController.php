<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Image;
use Validator;
use DB;
use App\Models\MasterVideo;
use App\Models\Events;
use App\Http\Requests;

class VideoController extends Controller
{
    public function __construct()
    {
        $this->middleware('isAdmin');
    }

    public function index()
    {
        //
        $getDataEvents = Events::leftJoin('master_kategori','events.id_kategori','=','master_kategori.id')
            ->select(['events.*','master_kategori.nama_kategori'])
                      ->orderBy('nama_kategori', 'ASC')
                      ->orderBy('judul_event', 'ASC')->get();

        $getVideo = MasterVideo::all();
        return view('backend.video.kelolavideo', compact('getVideo','getDataEvents'));
    }


    public function store(Request $request)
    {
        //
        // dd($request);
        $messages = [
          'eventsId.required' => 'Tidak boleh kosong.',
          'judul.*.required' => 'Tidak boleh kosong.',
          'urlVideo.*.required' => 'Tidak boleh kosong.',
          'activated.required' => 'Tidak boleh kosong.',
        ];

        $validator = Validator::make($request->all(), [
                'eventsId' => 'required',
                'judul' => 'required',
                'urlVideo' => 'required',
                'activated' => 'required',
            ], $messages);

        if ($validator->fails()) {
            return redirect()->route('video.index')->withErrors($validator)->withInput();
        }

        DB::transaction(function() use($request) {
            $dataItems = $request->data_item;
              foreach($dataItems as $dataItem){
              //set important video value
              $valimportantvideo="";
              if($dataItem['flagImportantVideo'] =="") {
                $valimportantvideo=0;
              } else {
                $valimportantvideo=1;
              }

              $set = new MasterVideo;
              $set->id_events = $request->eventsId;
              $set->judul = $dataItem['judulVideo'];
              $set->url_video = $dataItem['urlVideo'];
              $set->flag_important_video = $valimportantvideo;
              $set->flag_video = 1;
              $set->activated = $request->activated;
              $set->created_by = Auth::user()->id;
              $set->updated_by = Auth::user()->id;
              $set->save();
              }
        });

        \LogActivities::insLogActivities('log insert successfully.');

        return redirect()->route('video.index')->with('message', 'Berhasil memasukkan video baru.');
    }

    public function show($id)
    {
        //
        $set = MasterVideo::find($id);
        if($set->flag_video=="1") {
          $set->flag_video = 0;
        } elseif ($set->flag_video=="0") {
          $set->flag_video = 1;
        }

        $set->updated_by = Auth::user()->id;
        $set->save();

        \LogActivities::insLogActivities('log publish successfully.');

        return redirect()->route('video.index')->with('message', 'Berhasil mengubah publish video.');
    }

    public function editimportantvideo($id)
    {
        //
        $set = MasterVideo::find($id);
        if($set->flag_important_video=="1") {
          $set->flag_important_video = 0;
        } elseif ($set->flag_important_video=="0") {
          $set->flag_important_video = 1;
        }
        $set->updated_by = Auth::user()->id;
        $set->save();

        \LogActivities::insLogActivities('log update utama video successfully.');

        return redirect()->route('video.index')->with('message', 'Berhasil mengubah utama video.');
    }

    public function edit($id)
    {
        //
        $get = MasterVideo::find($id);
        return $get;
    }

    public function update(Request $request)
    {
        //
        $messages = [
          'id.required' => 'Tidak boleh kosong.',
          'eventsIdEdit.required' => 'Tidak boleh kosong.',
          'judulEdit.required' => 'Tidak boleh kosong.',
          'urlVideoEdit.required' => 'Tidak boleh kosong.',
        ];

        $validator = Validator::make($request->all(), [
                'id' => 'required',
                'eventsIdEdit' => 'required',
                'judulEdit' => 'required',
                'urlVideoEdit' => 'required',
            ], $messages);

        if ($validator->fails()) {
            return redirect()->route('video.index')->withErrors($validator)->withInput();
        }

        $set = MasterVideo::find($request->id);
        $set->id_events = $request->eventsIdEdit;
        $set->judul = $request->judulEdit;
        $set->url_video = $request->urlVideoEdit;
        $set->updated_by = Auth::user()->id;
        $set->save();

        \LogActivities::insLogActivities('log update successfully.');

        return redirect()->route('video.index')->with('message', 'Berhasil mengubah konten video.');
    }

    public function destroy($id, $status)
    {
        //
        $set = MasterVideo::find($id);
        if ($status == 'aktifkan') {
          $set->activated = 1;
        } else {
          $set->activated = 0;
        }
        $set->updated_by = Auth::user()->id;
        $set->save();

        \LogActivities::insLogActivities('log destroy successfully.');

        return redirect()->route('video.index')->with('message', 'Berhasil mengubah status video.');
    }
}
