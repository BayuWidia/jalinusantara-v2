<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Menu;
use App\Models\Events;
use App\Models\Informasi;
use Auth;
use DB;
use Carbon\Carbon;


class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('isAdmin');
    }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Http\Response
   */
    public function index()
    {

      if (Auth::user()->id_role != 4) {

        $getCountEvents = Events::where('flag_publish','=' ,1)->count();
        $getCountEventsUn = Events::where('flag_publish','=' ,0)->count();
        $getCountInformasi = Informasi::where('flag_publish','=' ,1)->where('flag_status','=' ,'article')->count();
        $getCountInformasiUn = Informasi::where('flag_publish','=' ,0)->where('flag_status','=' ,'article')->count();

        $informasiTerbaru = Informasi::leftJoin('master_kategori','informasi.id_kategori','=','master_kategori.id')
            ->leftJoin('master_users','informasi.created_by','=','master_users.id')
            ->select(['informasi.id as id_informasi',
                      'informasi.judul_informasi', 'master_kategori.nama_kategori',
                      'informasi.tanggal_publish', 'master_users.fullname',
                      'informasi.flag_headline', 'informasi.flag_publish', 'informasi.activated', 'informasi.view_counter', 'informasi.created_at'])
                      ->where('informasi.flag_status', '=', 'article')
                      ->orderBy('flag_publish', 'DESC')
                      ->orderBy('id_informasi', 'DESC')->limit(15)->get();

        $eventsTerbaru = Events::leftJoin('master_kategori','events.id_kategori','=','master_kategori.id')
            ->leftJoin('master_users','events.created_by','=','master_users.id')
            ->select(['events.id as id_events',
                      'events.judul_event', 'master_kategori.nama_kategori',
                      'events.lokasi', 'events.fasilitator', 'events.jumlah_peserta',
                      'events.flag_headline', 'events.flag_publish', 'events.activated', 'events.view_counter', 'events.created_at'])
                      ->orderBy('flag_publish', 'DESC')
                      ->orderBy('id_events', 'DESC')->limit(15)->get();

        $getCountEvents = Events::where('flag_publish','=' ,1)->count();
      } else {

        $getCountEvents = Events::where('flag_publish','=' ,1)->where('events.created_by', '=', Auth::user()->id)->count();
        $getCountEventsUn = Events::where('flag_publish','=' ,0)->where('events.created_by', '=', Auth::user()->id)->count();
        $getCountInformasi = Informasi::where('flag_publish','=' ,1)->where('informasi.created_by', '=', Auth::user()->id)->where('flag_status','=' ,'article')->count();
        $getCountInformasiUn = Informasi::where('flag_publish','=' ,0)->where('informasi.created_by', '=', Auth::user()->id)->where('flag_status','=' ,'article')->count();

        $informasiTerbaru = Informasi::leftJoin('master_kategori','informasi.id_kategori','=','master_kategori.id')
            ->leftJoin('master_users','informasi.created_by','=','master_users.id')
            ->select(['informasi.id as id_informasi',
                      'informasi.judul_informasi', 'master_kategori.nama_kategori',
                      'informasi.tanggal_publish', 'master_users.fullname',
                      'informasi.flag_headline', 'informasi.flag_publish', 'informasi.activated', 'informasi.view_counter', 'informasi.created_at'])
                      ->where('informasi.created_by', '=', Auth::user()->id)
                      ->where('informasi.flag_status', '=', 'article')
                      ->orderBy('flag_publish', 'DESC')
                      ->orderBy('id_informasi', 'DESC')->limit(15)->get();

        $eventsTerbaru = Events::leftJoin('master_kategori','events.id_kategori','=','master_kategori.id')
            ->leftJoin('master_users','events.created_by','=','master_users.id')
            ->select(['events.id as id_events',
                      'events.judul_event', 'master_kategori.nama_kategori',
                      'events.lokasi', 'events.fasilitator', 'events.jumlah_peserta',
                      'events.flag_headline', 'events.flag_publish', 'events.activated', 'events.view_counter', 'events.created_at'])
                      ->where('events.created_by', '=', Auth::user()->id)
                      ->orderBy('flag_publish', 'DESC')
                      ->orderBy('id_events', 'DESC')->limit(15)->get();
      }
      // $getkategori = DB::table('informasi')
      //                 ->join('master_kategori', 'informasi.id_kategori', '=', 'master_kategori.id')
      //                ->select('informasi.id_kategori', 'master_kategori.nama_kategori',
      //                   DB::raw('count(informasi.id_kategori) as jumlahkategori'))
      //                ->where('informasi.flag_status', '=', 'article')
      //                ->groupBy('informasi.id_kategori','master_kategori.nama_kategori')
      //                ->orderby('jumlahkategori', 'desc')
      //                ->paginate(5);

     $dt = Carbon::now();
     $getEventsToday = DB::table('events')->select(DB::raw('*'))
                 ->whereRaw('"'.$dt.'" between tanggal_mulai and tanggal_akhir')
                 ->where('flag_publish', '1')
                 ->get();
      return view('backend.dashboard.dashboard',
                    compact('informasiTerbaru','eventsTerbaru',
                            'getCountEvents', 'getCountEventsUn',
                            'getCountInformasi', 'getCountInformasiUn',
                            'getEventsToday'));
    }

}
