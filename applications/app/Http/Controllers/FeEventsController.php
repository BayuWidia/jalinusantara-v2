<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use Auth;
use Image;
use Validator;
use DB;
use Response;
use PDF;
use Excel;
use PHPExcel_Worksheet_Drawing;
use PHPExcel_Worksheet_PageSetup;
use App\Models\Events;
use App\Models\MasterSlider;
use App\Models\MasterSponsor;
use App\Models\RegistrasiEvents;
use App\Models\Mekanik;
use App\Models\Kendaraan;
use App\Models\Keluarga;
use App\Models\MasterKategori;
use App\Models\ParticipansHeader;
use App\Models\ParticipansDetail;
use App\Http\Requests;

use Carbon\Carbon;

class FeEventsController extends Controller
{

    public function index($id)
    {
      $getKategori = MasterKategori::select('*')->where('id','=',$id)->get();
      $getEvents = Events::join('master_kategori', 'events.id_kategori', '=', 'master_kategori.id')
                      ->leftJoin('master_users','events.created_by','=','master_users.id')
                      ->select('events.*', 'master_kategori.nama_kategori','master_users.name',
                                'master_users.fullname', 'master_users.email', 'master_users.url_foto as url_foto2')
                      ->where('events.id','!=','11')
                      ->where('events.id_kategori','=',$id)
                      ->where('flag_publish', 1)
                      ->orderBy('events.id', 'DESC')
                      ->get();

      return view('frontend.events.events', compact('getEvents','getKategori'));
    }

    public function indexById($id, $idKategori)
    {
      $getEvents = Events::join('master_kategori', 'events.id_kategori', '=', 'master_kategori.id')
                      ->leftJoin('master_users','events.created_by','=','master_users.id')
                      ->select('events.*', 'master_kategori.nama_kategori','master_users.name',
                                'master_users.fullname', 'master_users.email', 'master_users.url_foto as url_foto2')
                      ->where('events.id','=',$id)
                      ->where('flag_publish', 1)
                      ->get();

     $getRegistrasiEvents = RegistrasiEvents::select('*')
                          ->where('id_events', '=', $id)
                          ->where('flag_approve', '=', 1)
                          // ->paginate(20);
                          ->get();

     $getDataParticipans = ParticipansHeader::join('participans_detail', 'participans_header.id', '=', 'participans_detail.id_header')
                    ->select('participans_header.id_event', 'participans_header.nomor_pintu', 'participans_detail.*')
                    ->where('participans_header.id_event','=',$id)
                    ->where('flag_publish', 1)
                    ->orderBy('participans_header.id', 'ASC')
                    ->orderBy('participans_detail.nama', 'ASC')
                    ->get();
       return view('frontend.events.eventsById', compact('getEvents','getRegistrasiEvents','getDataParticipans'));
    }

    public function eventToday()
    {
        $dt = Carbon::now();
        $dt1 = Carbon::now()->addDays(1);
        $dt2 = Carbon::now()->addDays(2);
        $getDataEventsToday = Events::select('events.*')
                     ->whereRaw('"'.$dt.'" between tanggal_mulai and tanggal_akhir')
                     ->where('events.flag_headline', '=', '1')
                     ->where('flag_publish', '1')
                     ->orderBy('events.id', 'DESC')
                     ->get();
       $getDataEventsTomorrow = Events::select('events.*')
                    ->whereRaw('"'.$dt1.'" between tanggal_mulai and tanggal_akhir')
                    ->where('events.flag_headline', '=', '1')
                    ->where('flag_publish', '1')
                    ->orderBy('events.id', 'DESC')
                    ->get();
        $getDataEventsEtc = Events::select('events.*')
                     ->whereRaw('"'.$dt2.'" between tanggal_mulai and tanggal_akhir')
                     ->where('events.flag_headline', '=', '1')
                     ->where('flag_publish', '1')
                     ->orderBy('events.id', 'DESC')
                     ->get();
        return view('frontend.events.eventsToday', compact('getDataEventsToday'
                                                  ,'getDataEventsTomorrow','getDataEventsEtc'));
    }

    public function indexPendaftaran($id)
    {
      // dd(date("Y-m-d"));
      $getEvents = Events::where('events.id','=',$id)->get();
      return view('frontend.events.pendaftaran', compact('getEvents'));
    }

    public function storePendaftaran(Request $request)
    {
      // dd($request->all());
          // $messages = [
          //   'email1' =>  'Tidak boleh kosong.',
          //   'namaLengkap1' =>  'Tidak boleh kosong.',
          //   'nama1' =>  'Tidak boleh kosong.',
          //   'golonganDarah1' =>  'Tidak boleh kosong.',
          //   'tempatLahir1' =>  'Tidak boleh kosong.',
          //   'noTelp1' =>  'Tidak boleh kosong.',
          //   'alamat1' =>  'Tidak boleh kosong.',
          //   'ukuranKemeja1' =>  'Tidak boleh kosong.',
          //   'kota1' =>  'Tidak boleh kosong.',
          //   'noAnggotaIof1' =>  'Tidak boleh kosong.',
          //   'rhesus1' =>  'Tidak boleh kosong.',
          //   'tanggalLahir1' =>  'Tidak boleh kosong.',
          //   'kodePos1' =>  'Tidak boleh kosong.',
          //   'nomorSim1' =>  'Tidak boleh kosong.',
          //
          //   'email2' =>  'Tidak boleh kosong.',
          //   'namaLengkap2' =>  'Tidak boleh kosong.',
          //   'nama2' =>  'Tidak boleh kosong.',
          //   'golonganDarah2' =>  'Tidak boleh kosong.',
          //   'tempatLahir2' =>  'Tidak boleh kosong.',
          //   'noTelp2' =>  'Tidak boleh kosong.',
          //   'alamat2' =>  'Tidak boleh kosong.',
          //   'ukuranKemeja2' =>  'Tidak boleh kosong.',
          //   'kota2' =>  'Tidak boleh kosong.',
          //   'noAnggotaIof2' =>  'Tidak boleh kosong.',
          //   'rhesus2' =>  'Tidak boleh kosong.',
          //   'tanggalLahir2' =>  'Tidak boleh kosong.',
          //   'kodePos2' =>  'Tidak boleh kosong.',
          //   'nomorSim2' =>  'Tidak boleh kosong.',
          //
          //   'email3' =>  'Tidak boleh kosong.',
          //   'namaLengkap3' =>  'Tidak boleh kosong.',
          //   'nama3' =>  'Tidak boleh kosong.',
          //   'golonganDarah3' =>  'Tidak boleh kosong.',
          //   'tempatLahir3' =>  'Tidak boleh kosong.',
          //   'noTelp3' =>  'Tidak boleh kosong.',
          //   'alamat3' =>  'Tidak boleh kosong.',
          //   'ukuranKemeja3' =>  'Tidak boleh kosong.',
          //   'kota3' =>  'Tidak boleh kosong.',
          //   'noAnggotaIof3' =>  'Tidak boleh kosong.',
          //   'rhesus3' =>  'Tidak boleh kosong.',
          //   'tanggalLahir3' =>  'Tidak boleh kosong.',
          //   'kodePos3' =>  'Tidak boleh kosong.',
          //   'nomorSim3' =>  'Tidak boleh kosong.',
          //
          //   'email4' =>  'Tidak boleh kosong.',
          //   'namaLengkap4' =>  'Tidak boleh kosong.',
          //   'nama4' =>  'Tidak boleh kosong.',
          //   'golonganDarah4' =>  'Tidak boleh kosong.',
          //   'tempatLahir4' =>  'Tidak boleh kosong.',
          //   'noTelp4' =>  'Tidak boleh kosong.',
          //   'alamat4' =>  'Tidak boleh kosong.',
          //   'ukuranKemeja4' =>  'Tidak boleh kosong.',
          //   'kota4' =>  'Tidak boleh kosong.',
          //   'noAnggotaIof4' =>  'Tidak boleh kosong.',
          //   'rhesus4' =>  'Tidak boleh kosong.',
          //   'tanggalLahir4' =>  'Tidak boleh kosong.',
          //   'kodePos4' =>  'Tidak boleh kosong.',
          //   'nomorSim4' =>  'Tidak boleh kosong.',
          //
          //   'merek' =>  'Tidak boleh kosong.',
          //   'noPolisi' =>  'Tidak boleh kosong.',
          //   'typeMesin' =>  'Tidak boleh kosong.',
          //   'cc' =>  'Tidak boleh kosong.',
          //   'merekBan' =>  'Tidak boleh kosong.',
          //   'ukuranBan' =>  'Tidak boleh kosong.',
          //   'rollbar' =>  'Tidak boleh kosong.',
          //   'cargoBarrier' =>  'Tidak boleh kosong.',
          //   'sideBar' =>  'Tidak boleh kosong.',
          //   'safetyBelt' =>  'Tidak boleh kosong.',
          //   'type' =>  'Tidak boleh kosong.',
          //   'tahun' =>  'Tidak boleh kosong.',
          //   'warna' =>  'Tidak boleh kosong.',
          //   'snorkel' =>  'Tidak boleh kosong.',
          //   'engineCutOff' =>  'Tidak boleh kosong.',
          //   'gps' =>  'Tidak boleh kosong.',
          //   'radioKomunikasi' =>  'Tidak boleh kosong.',
          //   'winchDepanMerek' =>  'Tidak boleh kosong.',
          //   'winchDepanType' =>  'Tidak boleh kosong.',
          //   'winchBelakangMerek' =>  'Tidak boleh kosong.',
          //   'winchBelakangType' =>  'Tidak boleh kosong.',
          //   'snatchBlock' =>  'Tidak boleh kosong.',
          //   'shackle' =>  'Tidak boleh kosong.',
          //   'glove' =>  'Tidak boleh kosong.',
          //   'sling' =>  'Tidak boleh kosong.',
          //
          // ];
          //
          // $validator = Validator::make($request->all(), [
          //       'email1' =>  'required',
          //       'namaLengkap1' =>  'required',
          //       'nama1' =>  'required',
          //       'golonganDarah1' =>  'required',
          //       'tempatLahir1' =>  'required',
          //       'noTelp1' =>  'required',
          //       'alamat1' =>  'required',
          //       'ukuranKemeja1' =>  'required',
          //       'kota1' =>  'required',
          //       'noAnggotaIof1' =>  'required',
          //       'rhesus1' =>  'required',
          //       'tanggalLahir1' =>  'required',
          //       'kodePos1' =>  'required',
          //       'nomorSim1' =>  'required',
          //
          //       'email2' =>  'required',
          //       'namaLengkap2' =>  'required',
          //       'nama2' =>  'required',
          //       'golonganDarah2' =>  'required',
          //       'tempatLahir2' =>  'required',
          //       'noTelp2' =>  'required',
          //       'alamat2' =>  'required',
          //       'ukuranKemeja2' =>  'required',
          //       'kota2' =>  'required',
          //       'noAnggotaIof2' =>  'required',
          //       'rhesus2' =>  'required',
          //       'tanggalLahir2' =>  'required',
          //       'kodePos2' =>  'required',
          //       'nomorSim2' =>  'required',
          //
          //       'email3' =>  'required',
          //       'namaLengkap3' =>  'required',
          //       'nama3' =>  'required',
          //       'golonganDarah3' =>  'required',
          //       'tempatLahir3' =>  'required',
          //       'noTelp3' =>  'required',
          //       'alamat3' =>  'required',
          //       'ukuranKemeja3' =>  'required',
          //       'kota3' =>  'required',
          //       'noAnggotaIof3' =>  'required',
          //       'rhesus3' =>  'required',
          //       'tanggalLahir3' =>  'required',
          //       'kodePos3' =>  'required',
          //       'nomorSim3' =>  'required',
          //
          //       'email4' =>  'required',
          //       'namaLengkap4' =>  'required',
          //       'nama4' =>  'required',
          //       'golonganDarah4' =>  'required',
          //       'tempatLahir4' =>  'required',
          //       'noTelp4' =>  'required',
          //       'alamat4' =>  'required',
          //       'ukuranKemeja4' =>  'required',
          //       'kota4' =>  'required',
          //       'noAnggotaIof4' =>  'required',
          //       'rhesus4' =>  'required',
          //       'tanggalLahir4' =>  'required',
          //       'kodePos4' =>  'required',
          //       'nomorSim4' =>  'required',
          //
          //       'merek' =>  'required',
          //       'noPolisi' =>  'required',
          //       'typeMesin' =>  'required',
          //       'cc' =>  'required',
          //       'merekBan' =>  'required',
          //       'ukuranBan' =>  'required',
          //       'rollbar' =>  'required',
          //       'cargoBarrier' =>  'required',
          //       'sideBar' =>  'required',
          //       'safetyBelt' =>  'required',
          //       'type' =>  'required',
          //       'tahun' =>  'required',
          //       'warna' =>  'required',
          //       'snorkel' =>  'required',
          //       'engineCutOff' =>  'required',
          //       'gps' =>  'required',
          //       'radioKomunikasi' =>  'required',
          //       'winchDepanMerek' =>  'required',
          //       'winchDepanType' =>  'required',
          //       'winchBelakangMerek' =>  'required',
          //       'winchBelakangType' =>  'required',
          //       'snatchBlock' =>  'required',
          //       'shackle' =>  'required',
          //       'glove' =>  'required',
          //       'sling' =>  'required',
          //     ], $messages);
          //
          // if ($validator->fails()) {
          //     return redirect()->route('events.pendaftaran', ['id' => $request->idEvents])->withErrors($validator)->withInput();
          // }

          DB::transaction(function() use($request) {
            $sysDate = date('Ymd');
            $getMaxCode = RegistrasiEvents::getMaxRegistrasiCode($request->idEvents);
            if ($getMaxCode[0]->no_registrasi_code != null) {
              $setCode = $getMaxCode[0]->no_registrasi_code+1;
            } else {
              $setCode = $sysDate.'0'.$request->idEvents.'0001';
            }

            //Tempopary ins data pengalaman 1
            $tempPengalaman1 = "";
            $dataPengalaman1s = $request->input('dataPengalaman1');
            foreach($dataPengalaman1s as $dataPengalaman1){
              $tempPengalaman1 = $tempPengalaman1.','.$dataPengalaman1['namaEvent1'].'-'.$dataPengalaman1['tahunEvent1'];
            }

            //Tempopary ins data pengalaman 2
            $tempPengalaman2 = "";
            $dataPengalaman2s = $request->input('dataPengalaman2');
            foreach($dataPengalaman2s as $dataPengalaman2){
              $tempPengalaman2 = $tempPengalaman2.','.$dataPengalaman2['namaEvent2'].'-'.$dataPengalaman2['tahunEvent2'];
            }

            //Tempopary ins data pengalaman 3
            $tempPengalaman3 = "";
            $dataPengalaman3s = $request->input('dataPengalaman3');
            foreach($dataPengalaman3s as $dataPengalaman3){
              $tempPengalaman3 = $tempPengalaman3.','.$dataPengalaman3['namaEvent3'].'-'.$dataPengalaman3['tahunEvent3'];
            }

            //Tempopary ins data pengalaman 4
            $tempPengalaman4 = "";
            $dataPengalaman4s = $request->input('dataPengalaman4');
            foreach($dataPengalaman4s as $dataPengalaman4){
              $tempPengalaman4 = $tempPengalaman4.','.$dataPengalaman4['namaEvent4'].'-'.$dataPengalaman4['tahunEvent4'];
            }

            //Tempopary ins data Spec Up Kendaraan
            $tempSpecUp = "";
            $dataSpecUpKendaraans = $request->input('dataSpecUpKendaraan');
            foreach($dataSpecUpKendaraans as $dataSpecUpKendaraan){
              $tempSpecUp = $tempSpecUp.','.$dataSpecUpKendaraan['namaSpecUpKendaraan'];
            }

            //Tempopary ins data Strap
            $tempStrap = "";
            $dataStraps = $request->input('dataStrap');
            foreach($dataStraps as $dataStrap){
              $tempStrap = $tempStrap.','.$dataStrap['merekStrap'].'-'.$dataStrap['merekPanjang'];
            }

            // dd($request->all());
            //insert table register event's
            $registrasi = RegistrasiEvents::create([
                  'id_events' => $request->idEvents,
                  'no_registrasi' => $setCode,
                  'email' => $request->email1,
                  'email_co' => $request->email2,
                  'nama_lengkap_driver' => $request->namaLengkap1,
                  'nama_lengkap_co_driver' => $request->namaLengkap2,
                  'nama_driver' => $request->nama1,
                  'nama_co_driver' => $request->nama2,
                  'golongan_darah_driver' => $request->golonganDarah1,
                  'golongan_darah_co_driver' => $request->golonganDarah2,
                  'tmp_lahir_driver' => $request->tempatLahir1,
                  'tmp_lahir_co_driver' => $request->tempatLahir2,
                  'ukuran_kemeja_driver' => $request->ukuranKemeja1,
                  'ukuran_kemeja_co_driver' => $request->ukuranKemeja2,
                  'alamat_driver' => $request->alamat1,
                  'alamat_co_driver' => $request->alamat2,
                  'kota_driver' => $request->kota1,
                  'kota_co_driver' => $request->kota2,
                  'no_anggota_iof' => $request->noAnggotaIof1,
                  'no_anggota_iof_co' => $request->noAnggotaIof2,
                  'rhesus' => $request->rhesus1,
                  'rhesus_co' => $request->rhesus2,
                  'tgl_lhr_driver' => $request->tanggalLahir1,
                  'tgl_lhr_co_driver' => $request->tanggalLahir2,
                  'kode_pos' => $request->kodePos1,
                  'kode_pos_co' => $request->kodePos2,
                  'no_sim_driver' => $request->nomorSim1,
                  'no_sim_co_driver' => $request->nomorSim2,
                  'pengalaman_event_driver' => $tempPengalaman1,
                  'pengalaman_event_co_driver' => $tempPengalaman2,
                  'no_telp_driver' => $request->noTelp1,
                  'no_telp_co_driver' => $request->noTelp2,
                  'nomor_pintu' => 0,
                  'flag_approve' => 0,
                  'file_name' => '',
                  'status_register' => 'FORM',
                  'activated' => 1,
                  'created_by' => $request->email1,
                  'updated_by' => $request->email1,
            ]);

                //insert table mekanik1
                $setMekanik1 = new Mekanik;
                $setMekanik1->id_registrasi = $registrasi->id;
                $setMekanik1->email = $request->email3;
                $setMekanik1->nama_lengkap_mekanik = $request->namaLengkap3;
                $setMekanik1->nama_mekanik = $request->nama3;
                $setMekanik1->golongan_darah_mekanik = $request->golonganDarah3;
                $setMekanik1->tmp_lahir_mekanik = $request->tempatLahir3;
                $setMekanik1->no_telp_mekanik = $request->noTelp3;
                $setMekanik1->ukuran_kemeja_mekanik = $request->ukuranKemeja3;
                $setMekanik1->alamat_mekanik = $request->alamat3;
                $setMekanik1->kota_mekanik = $request->kota3;
                $setMekanik1->no_anggota_iof = $request->noAnggotaIof3;
                $setMekanik1->rhesus = $request->rhesus3;
                $setMekanik1->tgl_lhr_mekanik = $request->tanggalLahir3;
                $setMekanik1->kode_pos = $request->kodePos3;
                $setMekanik1->no_sim_mekanik = $request->nomorSim3;
                $setMekanik1->pengalaman_event_mekanik = $tempPengalaman3;
                $setMekanik1->activated = 1;
                $setMekanik1->created_by = $request->email1;
                $setMekanik1->updated_by =$request->email1;
                $setMekanik1->save();

                //insert table mekanik2
                $setMekanik2 = new Mekanik;
                $setMekanik2->id_registrasi = $registrasi->id;
                $setMekanik2->email = $request->email4;
                $setMekanik2->nama_lengkap_mekanik = $request->namaLengkap4;
                $setMekanik2->nama_mekanik = $request->nama4;
                $setMekanik2->golongan_darah_mekanik = $request->golonganDarah4;
                $setMekanik2->tmp_lahir_mekanik = $request->tempatLahir4;
                $setMekanik2->no_telp_mekanik = $request->noTelp4;
                $setMekanik2->ukuran_kemeja_mekanik = $request->ukuranKemeja4;
                $setMekanik2->alamat_mekanik = $request->alamat4;
                $setMekanik2->kota_mekanik = $request->kota4;
                $setMekanik2->no_anggota_iof = $request->noAnggotaIof4;
                $setMekanik2->rhesus = $request->rhesus4;
                $setMekanik2->tgl_lhr_mekanik = $request->tanggalLahir4;
                $setMekanik2->kode_pos = $request->kodePos4;
                $setMekanik2->no_sim_mekanik = $request->nomorSim4;
                $setMekanik2->pengalaman_event_mekanik = $tempPengalaman4;
                $setMekanik2->activated = 1;
                $setMekanik2->created_by = $request->email1;
                $setMekanik2->updated_by =$request->email1;
                $setMekanik2->save();

                //insert table kendaraan
                $setKendaraan = new Kendaraan;
                $setKendaraan->id_registrasi = $registrasi->id;
                $setKendaraan->merek = $request->merek;
                $setKendaraan->no_polisi = $request->noPolisi;
                $setKendaraan->type_mesin = $request->typeMesin;
                $setKendaraan->cc = $request->cc;
                $setKendaraan->merek_ban = $request->merekBan;
                $setKendaraan->ukuran_ban = $request->ukuranBan;
                $setKendaraan->rollbar = $request->rollbar;
                $setKendaraan->cargo_barrier = $request->cargoBarrier;
                $setKendaraan->side_bar = $request->sideBar;
                $setKendaraan->safety_belt = $request->safetyBelt;
                $setKendaraan->spec_up_kendaraan = $tempSpecUp;
                $setKendaraan->type = $request->type;
                $setKendaraan->tahun = $request->tahun;
                $setKendaraan->warna = $request->warna;
                $setKendaraan->snorkel = $request->snorkel;
                $setKendaraan->engine_cut_off = $request->engineCutOff;
                $setKendaraan->gps = $request->gps;
                $setKendaraan->radio_komunikasi = $request->radioKomunikasi;
                $setKendaraan->winch_depan_merek = $request->winchDepanMerek;
                $setKendaraan->winch_depan_type = $request->winchDepanType;
                $setKendaraan->strap = $tempStrap;
                $setKendaraan->winch_belakang_merek = $request->winchBelakangMerek;
                $setKendaraan->winch_belakang_type = $request->winchBelakangType;
                $setKendaraan->snatch_block = $request->snatchBlock;
                $setKendaraan->shackle = $request->shackle;
                $setKendaraan->glove = $request->glove;
                $setKendaraan->sling = $request->sling;
                $setKendaraan->created_by = $request->email1;
                $setKendaraan->updated_by = $request->email1;
                $setKendaraan->save();

              //insert table keluarga
              $dataKeluargas = $request->input('dataKeluarga');
              foreach($dataKeluargas as $dataKeluarga){
                $set = new Keluarga;
                $set->id_registrasi    = $registrasi->id;
                $set->email    = $dataKeluarga['emailKeluarga'];
                $set->nama_lengkap_keluarga    = $dataKeluarga['namaLengkapKeluarga'];
                $set->nama_keluarga    = $dataKeluarga['namaKeluarga'];
                $set->hubungan_keluarga    = $dataKeluarga['hubunganKeluarga'];
                $set->no_telp_keluarga    = $dataKeluarga['noTelpKeluarga'];
                $set->no_hp_keluarga    = $dataKeluarga['noHpKeluarga'];
                $set->activated  = 1;
                $set->created_by = $request->email1;
                $set->save();
              }

          });

          \LogActivities::insLogActivities('log insert successfully.');

          return redirect()->route('events.pendaftaran', ['id' => $request->idEvents])->with('message', 'Pendaftaran pada events tersebut berhasil.');
    }

    public function getDownload(){
        //PDF file is stored under project/public/download/info.pdf
        $file= public_path(). "\download\FILE_UPLOAD_REGISTER.xls";
        // dd($file);
        $headers = array(
                  'Content-Type: application/xls',
                );

        return Response::download($file, 'FILE_UPLOAD_REGISTER.xls', $headers);
    }

    public function storePendaftaranByUpload(Request $request)
    {
      if(Input::hasFile('uploadFile')){

        DB::transaction(function() use($request) {
          $sysDate = date('Ymd');
          $getMaxCode = RegistrasiEvents::getMaxRegistrasiCode($request->idEvents);
          if ($getMaxCode[0]->no_registrasi_code != null) {
            $setCode = $getMaxCode[0]->no_registrasi_code+1;
          } else {
            $setCode = $sysDate.'0'.$request->idEvents.'0001';
          }

      		$path = Input::file('uploadFile')->getRealPath();

          $dataDriver = Excel::selectSheets('Data-Driver')->load($path)->get();
          $dataMekanik = Excel::selectSheets('Data-Mekanik')->load($path)->get();
          $dataKendaraan = Excel::selectSheets('Data-Kendaraan')->load($path)->get();
          $dataContact = Excel::selectSheets('Data-Contact')->load($path)->get();

          $file = $request->file('uploadFile');
          $fileName = $file->getClientOriginalName().'-'.date('ymdhis');
          if(!empty($dataDriver) && $dataDriver->count()){
            //foreach untuk data sheets Driver
            // dd($dataDriver);
          	foreach ($dataDriver as $key) {
              //insert table register event's
                if($key->email != null){
                    $registrasi = RegistrasiEvents::create([
                                  'id_events' => $request->idEvents,
                                  'no_registrasi' => $setCode,
                                  'email' => $key->email,
                                  'email_co' => $key->email_co,
                                  'nama_lengkap_driver' => $key->nama_lengkap_driver,
                                  'nama_lengkap_co_driver' => $key->nama_lengkap_co_driver,
                                  'nama_driver' => $key->nama_driver,
                                  'nama_co_driver' => $key->nama_co_driver,
                                  'golongan_darah_driver' => $key->golongan_darah_driver,
                                  'golongan_darah_co_driver' => $key->golongan_darah_co_driver,
                                  'tmp_lahir_driver' => $key->tmp_lahir_driver,
                                  'tmp_lahir_co_driver' => $key->tmp_lahir_co_driver,
                                  'ukuran_kemeja_driver' => $key->ukuran_kemeja_driver,
                                  'ukuran_kemeja_co_driver' => $key->ukuran_kemeja_co_driver,
                                  'alamat_driver' => $key->alamat_driver,
                                  'alamat_co_driver' => $key->alamat_co_driver,
                                  'kota_driver' => $key->kota_driver,
                                  'kota_co_driver' => $key->kota_co_driver,
                                  'no_anggota_iof' => $key->no_anggota_iof,
                                  'no_anggota_iof_co' => $key->no_anggota_iof_co,
                                  'rhesus' => $key->rhesus,
                                  'rhesus_co' => $key->rhesus_co,
                                  'tgl_lhr_driver' => date("Y-m-d", strtotime($key->tgl_lhr_driver)),
                                  'tgl_lhr_co_driver' => date("Y-m-d", strtotime($key->tgl_lhr_co_driver)),
                                  'kode_pos' => $key->kode_pos,
                                  'kode_pos_co' => $key->kode_pos_co,
                                  'no_sim_driver' => $key->no_sim_driver,
                                  'no_sim_co_driver' => $key->no_sim_co_driver,
                                  'pengalaman_event_driver' => $key->pengalaman_event_driver,
                                  'pengalaman_event_co_driver' => $key->pengalaman_event_co_driver,
                                  'no_telp_driver' => $key->no_telp_driver,
                                  'no_telp_co_driver' => $key->no_telp_co_driver,
                                  'nomor_pintu' => 0,
                                  'flag_approve' => 0,
                                  'file_name' => $fileName,
                                  'status_register' => 'UPLOAD',
                                  'activated' => 1,
                                  'created_by' => $key->email,
                                  'updated_by' => $key->email,
                    ]);
                }
          	 }
              //foreach untuk data sheets Mekanik
              foreach ($dataMekanik as $key) {
                // dd($key);
                if($key->email != null){
                  $set = new Mekanik;
                  $set->id_registrasi = $registrasi->id;
                  $set->email = $key->email;
                  $set->nama_lengkap_mekanik = $key->nama_lengkap_mekanik;
                  $set->nama_mekanik = $key->nama_mekanik;
                  $set->golongan_darah_mekanik = $key->golongan_darah_mekanik;
                  $set->tmp_lahir_mekanik = $key->tmp_lahir_mekanik;
                  $set->no_telp_mekanik = $key->no_telp_mekanik;
                  $set->ukuran_kemeja_mekanik = $key->ukuran_kemeja_mekanik;
                  $set->alamat_mekanik = $key->alamat_mekanik;
                  $set->kota_mekanik = $key->kota_mekanik;
                  $set->no_anggota_iof = $key->no_anggota_iof;
                  $set->rhesus = $key->rhesus;
                  $set->tgl_lhr_mekanik = date("Y-m-d", strtotime($key->tgl_lhr_mekanik));
                  $set->kode_pos = $key->kode_pos;
                  $set->no_sim_mekanik = $key->no_sim_mekanik;
                  $set->pengalaman_event_mekanik = $key->pengalaman_event_mekanik;
                  $set->activated = 1;
                  $set->created_by = $registrasi->id;
                  $set->updated_by = $registrasi->id;
                  $set->save();
                }
            	}

              //foreach untuk data sheets Kendaraan
              // dd($dataKendaraan);
              foreach ($dataKendaraan as $key) {
                  if($key->merek != null){
                      $set = new Kendaraan;
                      $set->id_registrasi = $registrasi->id;
                      $set->merek = $key->merek;
                      $set->no_polisi = $key->no_polisi;
                      $set->type_mesin = $key->type_mesin;
                      $set->cc = $key->cc;
                      $set->merek_ban = $key->merek_ban;
                      $set->ukuran_ban = $key->ukuran_ban;
                      $set->rollbar = $key->rollbar;
                      $set->cargo_barrier = $key->cargo_barrier;
                      $set->side_bar = $key->side_bar;
                      $set->safety_belt = $key->safety_belt;
                      $set->spec_up_kendaraan = $key->spec_up_kendaraan;
                      $set->type = $key->type;
                      $set->tahun = $key->tahun;
                      $set->warna = $key->warna;
                      $set->snorkel = $key->snorkel;
                      $set->engine_cut_off = $key->engine_cut_off;
                      $set->gps = $key->gps;
                      $set->radio_komunikasi = $key->radio_komunikasi;
                      $set->winch_depan_merek = $key->winch_depan_merek;
                      $set->winch_depan_type = $key->winch_depan_type;
                      $set->strap = $key->strap;
                      $set->winch_belakang_merek = $key->winch_belakang_merek;
                      $set->winch_belakang_type = $key->winch_belakang_type;
                      $set->snatch_block = $key->snatch_block;
                      $set->shackle = $key->shackle;
                      $set->glove = $key->glove;
                      $set->sling = $key->sling;
                      $set->created_by = $registrasi->id;
                      $set->updated_by = $registrasi->id;
                      $set->save();
                  }
            	}

              //foreach untuk data sheets Contact

              // dd($dataContact);
              foreach ($dataContact as $key) {
                if($key->nama_lengkap_keluarga != null){
                  $set = new Keluarga;
                  $set->id_registrasi = $registrasi->id;
                  $set->email = $key->email;
                  $set->nama_lengkap_keluarga = $key->nama_lengkap_keluarga;
                  $set->nama_keluarga = $key->nama_keluarga;
                  $set->hubungan_keluarga = $key->hubungan_keluarga;
                  $set->no_telp_keluarga = $key->no_telp_keluarga;
                  $set->no_hp_keluarga = $key->no_hp_keluarga;
                  $set->activated = 1;
                  $set->created_by = $registrasi->id;
                  $set->save();
               }
            	}

            if(!empty($registrasi)){
              \LogActivities::insLogActivities('log insert successfully.');

              return redirect()->route('eventsById', ['id' => $request->idEvents, 'idKategori' => $request->idKategori])->with('message', 'Pendaftaran pada events tersebut berhasil.');
            }
          }
        });

  		}

  		return back()->with('error', 'Harap Pilih File Sesuai Dengan Template');
    }

}
