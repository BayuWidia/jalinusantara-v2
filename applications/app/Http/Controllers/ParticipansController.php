<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Image;
use Validator;
use DB;
use App\Models\ParticipansHeader;
use App\Models\ParticipansDetail;
use App\Models\Events;
use App\Http\Requests;


class ParticipansController extends Controller
{

    public function __construct()
    {
        $this->middleware('isAdmin');
    }

    public function index()
    {
        //
        $getDataParticipans = ParticipansHeader::leftJoin('events','participans_header.id_event','=','events.id')
            ->select(['participans_header.*','events.judul_event'])
                      ->orderBy('events.judul_event', 'ASC')
                      ->orderBy('participans_header.nomor_pintu', 'ASC')->get();

        return view('backend.participans.index', compact('getDataParticipans'));
    }

    public function create()
    {
        //
        $getDataEvents = Events::leftJoin('master_kategori','events.id_kategori','=','master_kategori.id')
            ->select(['events.*','master_kategori.nama_kategori'])
                      ->orderBy('nama_kategori', 'ASC')
                      ->orderBy('judul_event', 'ASC')->get();
        return view('backend.participans.tambah', compact('getDataEvents'));
    }


    public function store(Request $request)
    {
          DB::transaction(function() use($request) {
              $fileParticipans = $request->file('urlFile');
              $participansName = "";
              if($fileParticipans!=null){
                $participansName = 'participans_'.Auth::user()->email.'_'.time(). '.' . $fileParticipans->getClientOriginalExtension();
                $fileParticipans->move('documents', $participansName);
              }
              $participans = ParticipansHeader::create([
                  'id_event' => $request->eventsId,
                  'nomor_pintu' => $request->nomorPintu,
                  'url_file' => $participansName,
                  'flag_publish' => 1,
                  'activated' => $request->activated,
                  'created_by' => Auth::user()->id,
              ]);

              $dataItems = $request->data_item;
                foreach($dataItems as $dataItem){

                  $set = new ParticipansDetail;
                  $set->id_header = $participans->id;
                  $set->nama = $dataItem['nama'];
                  $set->posisi = $dataItem['posisi'];
                  $set->pax = $dataItem['pax'];
                  $set->mobil = $dataItem['mobil'];
                  $set->nomor_polisi = $dataItem['nomorPolisi'];
                  $set->telephone = $dataItem['telephone'];
                  $set->ukuran_baju = $dataItem['ukuranBaju'];
                  $set->bahan_bakar = $dataItem['bahanBakar'];
                  $set->activated = 1;
                  $set->created_by = Auth::user()->id;
                  $set->save();
                }
          });

          \LogActivities::insLogActivities('log insert successfully.');

          return redirect()->route('participans.index')->with('message', 'Berhasil memasukkan participans baru.');
    }

    public function show($id)
    {
        //
        $set = ParticipansHeader::find($id);
        if($set->flag_publish=="1") {
          $set->flag_publish = 0;
        } elseif ($set->flag_publish=="0") {
          $set->flag_publish = 1;
        }
        $set->updated_by = Auth::user()->id;
        $set->save();

        \LogActivities::insLogActivities('log publish successfully.');

        return redirect()->route('participans.index')->with('message', 'Berhasil mengubah publish participans.');
    }

    public function bindParticipansDetail($id)
    {
        $get = ParticipansDetail::find($id);
        return $get;
    }

    public function edit($id)
    {
        //
        $editParticipans = ParticipansHeader::find($id);

        $getDataParticipans = ParticipansDetail::where('id_header', $id)->get();

        $getDataEvents = Events::leftJoin('master_kategori','events.id_kategori','=','master_kategori.id')
            ->select(['events.*','master_kategori.nama_kategori'])
                      ->orderBy('nama_kategori', 'ASC')
                      ->orderBy('judul_event', 'ASC')->get();

        return view('backend/participans/edit', compact('editParticipans', 'getDataEvents','getDataParticipans'));
    }

    public function view($id)
    {
        //
        $viewParticipans = ParticipansHeader::find($id);

        $getDataParticipans = ParticipansDetail::where('id_header', $id)->get();

        $getDataEvents = Events::leftJoin('master_kategori','events.id_kategori','=','master_kategori.id')
            ->select(['events.*','master_kategori.nama_kategori'])
                      ->orderBy('nama_kategori', 'ASC')
                      ->orderBy('judul_event', 'ASC')->get();

        return view('backend/participans/edit', compact('viewParticipans', 'getDataEvents','getDataParticipans'));
    }

    public function updateHeader(Request $request)
    {

        $set = ParticipansHeader::find($request->id);
        $set->id_events = $request->eventsId;
        $fileParticipans = $request->file('urlFile');
        if($fileParticipans!=null){
          $participansName = 'participans_'.Auth::user()->email.'_'.time(). '.' . $fileParticipans->getClientOriginalExtension();
          $fileParticipans->move('documents', $participansName);
          $set->url_file = $participansName;
        }
        $set->nomor_pintu = $request->nomorPintu;
        $set->updated_by = Auth::user()->id;
        $set->save();

        \LogActivities::insLogActivities('log update successfully.');

        return redirect()->route('participans.edit', $request->eventsId)->with('message','Berhasil mengubah data participans.');
    }

    public function insertDetail(Request $request)
    {

        $set = new ParticipansDetail;
        $set->id_header = $request->participansIdHeader;
        $set->nama = $request->nama;
        $set->posisi = $request->posisi;
        $set->pax = $request->pax;
        $set->mobil = $request->mobil;
        $set->nomor_polisi = $request->nomorPolisi;
        $set->telephone = $request->telephone;
        $set->ukuran_baju = $request->ukuranBaju;
        $set->bahan_bakar = $request->bahanBakar;
        $set->created_by = Auth::user()->id;
        $set->save();

        \LogActivities::insLogActivities('log update successfully.');

        // return redirect()->route('participans.index')->with('message', 'Berhasil mengubah konten participans.');
        return redirect()->route('participans.edit', $request->eventsId)->with('message','Berhasil memasukkan data participans.');
    }

    public function updateDetail(Request $request)
    {

        $set = ParticipansDetail::find($request->idDetail);
        $set->id_header = $request->participansIdHeaderEdit;
        $set->nama = $request->namaEdit;
        $set->posisi = $request->posisiEdit;
        $set->pax = $request->paxEdit;
        $set->mobil = $request->mobilEdit;
        $set->nomor_polisi = $request->nomorPolisiEdit;
        $set->telephone = $request->telephoneEdit;
        $set->ukuran_baju = $request->ukuranBajuEdit;
        $set->bahan_bakar = $request->bahanBakarEdit;
        $set->updated_by = Auth::user()->id;
        $set->save();

        \LogActivities::insLogActivities('log update successfully.');

        // return redirect()->route('participans.index')->with('message', 'Berhasil mengubah konten participans.');
        return redirect()->route('participans.edit', $request->eventsId)->with('message','Berhasil mengubah data participans.');
    }

    public function destroyHeader($id, $status)
    {
        $set = ParticipansHeader::find($id);
        if ($status == 'aktifkan') {
          $set->activated = 1;
        } else {
          $set->activated = 0;
        }
        $set->updated_by = Auth::user()->id;
        $set->save();

        \LogActivities::insLogActivities('log destroy successfully.');

        return redirect()->route('participans.index')->with('message', 'Berhasil mengubah status participans.');
    }


    public function destroyDetail($id, $status, $eventsId)
    {
        $set = ParticipansDetail::find($id);
        if ($status == 'aktifkan') {
          $set->activated = 1;
        } else {
          $set->activated = 0;
        }
        $set->updated_by = Auth::user()->id;
        $set->save();

        \LogActivities::insLogActivities('log destroy successfully.');

        // return redirect()->route('participans.index')->with('message', 'Berhasil mengubah status participans.');
        return redirect()->route('participans.edit', $eventsId)->with('message','Berhasil mengubah data participans.');
    }
}
