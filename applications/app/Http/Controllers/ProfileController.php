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
use App\Models\Informasi;
use App\Models\MasterKategori;
use App\Http\Requests;

class ProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware('isAdmin');
    }

    public function index()
    {
        //
        return view('backend.profile.index');
    }

    public function getDataForDataTable()
    {

      if (Auth::user()->id_role != 4) {
        $querys = Informasi::leftJoin('master_kategori','informasi.id_kategori','=','master_kategori.id')
            ->leftJoin('master_users','informasi.created_by','=','master_users.id')
            ->select(['informasi.id as id_informasi',
                      'informasi.judul_informasi', 'master_kategori.nama_kategori',
                      'informasi.tanggal_publish', 'informasi.flag_publish', 'informasi.activated'])
                      ->where('informasi.flag_status', '=', 'profile')
                      ->orderBy('id_informasi', 'DESC');
      } else {
        $querys = Informasi::leftJoin('master_kategori','informasi.id_kategori','=','master_kategori.id')
            ->leftJoin('master_users','informasi.created_by','=','master_users.id')
            ->select(['informasi.id as id_informasi',
                      'informasi.judul_informasi', 'master_kategori.nama_kategori',
                      'informasi.tanggal_publish', 'informasi.flag_publish', 'informasi.activated'])
                      ->where('informasi.created_by', '=', Auth::user()->id)
                      ->where('informasi.flag_status', '=', 'profile')
                      ->orderBy('id_informasi', 'DESC');
      }

                      // dd($querys);
      return Datatables::of($querys)
        ->addColumn('action', function($query){
            if ($query->flag_publish == "1") {
              $strPublish = '<a href="#" class="btn btn-warning btn-circle waves-effect waves-circle waves-float flagpublish"
                              data-toggle="modal" data-target="#modalflagpublish" data-value="'.$query->id_informasi.'"
                              data-backdrop="static" data-keyboard="false"><i class="material-icons">star</i></a>';
            } else {
              $strPublish = '<a href="#" class="btn bg-blue-grey btn-circle waves-effect waves-circle waves-float flagpublish"
                                data-toggle="modal" data-target="#modalflagpublish" data-value="'.$query->id_informasi.'"
                                data-backdrop="static" data-keyboard="false"><i class="material-icons">star_border</i></a>';
            }

            if ($query->activated == "1") {
              $strDelete = '<a href="#" class="btn btn-danger btn-circle waves-effect waves-circle waves-float hapus"
                              data-toggle="modal" data-target="#modaldelete"
                              data-value="'.$query->id_informasi.'" data-backdrop="static"
                              data-keyboard="false"><i class="material-icons">delete_forever</i></a>';
            } else {
              $strDelete = '<a href="#" class="btn bg-blue-grey btn-circle waves-effect waves-circle waves-float aktifkan"
                              data-toggle="modal" data-target="#modalAktifkan"
                              data-value="'.$query->id_informasi.'" data-backdrop="static"
                              data-keyboard="false"><i class="material-icons">thumb_down</i></a>';
            }

            $strUpd = '<a href="admin/profile.edit/'.$query->id_informasi.'" class="btn btn-success btn-circle waves-effect waves-circle waves-float">
                          <i class="material-icons">open_in_new</i></a>';

            $strView = '<a href="admin/profile.view/'.$query->id_informasi.'" class="btn btn-primary btn-circle waves-effect waves-circle waves-float">
                          <i class="material-icons">remove_red_eye</i></a>';

            if (Auth::user()->id_role != 4) {
                  return $strPublish.' '.$strUpd.' '.$strDelete.' '.$strView;
            } else{
                  if ($query->flag_publish == "1") {
                    return $strView;
                  } else {
                    return $strUpd.' '.$strDelete.' '.$strView;
                  }
            }

        })
        ->editColumn('tanggal_publish', function ($query)
        {
            return Carbon::parse($query->tanggal_publish)->format('d-m-Y');
        })
        ->editColumn('flag_publish', function($query){
          if ($query->flag_publish=="1") {
            return "<span class='badge bg-orange'>Publish</span>";
          } elseif ($query->flag_publish=="0")  {
            return "<span class='badge bg-blue-grey'>Un Publish</span>";
          }
        })
        ->removeColumn('activated')
        ->removeColumn('id_informasi')
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
        $getKategori = MasterKategori::where('flag_utama','=' ,'profile')->get();
        return view('backend.profile.tambah', compact('getKategori'));
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
            'isiKonten.required' => 'Tidak boleh kosong.',
            'kategoriId.not_in' => 'Pilih salah satu.',
          ];

          $validator = Validator::make($request->all(), [
                  'judul' => 'required',
                  'kategoriId' => 'required',
                  'isiKonten' => 'required',
                  'kategoriId' => 'required|not_in:-- Pilih --',
              ], $messages);

          if ($validator->fails()) {
              return redirect()->route('profile.tambah')->withErrors($validator)->withInput();
          }

          // $checkdouble = Informasi::where('id_kategori','=' ,$request->kategoriId)->get();
          //
          // if ($checkdouble != null) {
          //   return redirect()->route('profile.tambah')->with('messagefail', 'Kategori sudah tersedia.');
          // }

          $setTglPosting = date('Y-m-d');
          $set = new Informasi;
          $set->judul_informasi = $request->judul;
          $set->id_kategori = $request->kategoriId;
          $set->isi_informasi = $request->isiKonten;
          $set->tanggal_publish = $setTglPosting;
          $set->flag_status = 'profile';
          $set->activated = 1;
          $set->created_by = Auth::user()->id;
          $set->save();

          \LogActivities::insLogActivities('log insert successfully.');

          return redirect()->route('profile.index')->with('message', 'Berhasil memasukkan profile baru.');
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
        $set = Informasi::find($id);
        if($set->flag_publish=="1") {
          $set->flag_publish = 0;
        } elseif ($set->flag_publish=="0") {
          $set->flag_publish = 1;
        }
        $set->updated_by = Auth::user()->id;
        $set->save();

        \LogActivities::insLogActivities('log publish successfully.');

        return redirect()->route('profile.index')->with('message', 'Berhasil mengubah publish profile.');
    }

    public function headline($id)
    {
        //
        $set = Informasi::find($id);
        if($set->flag_headline=="1") {
          $set->flag_headline = 0;
        } elseif ($set->flag_headline=="0") {
          $set->flag_headline = 1;
        }
        $set->updated_by = Auth::user()->id;
        $set->save();

        \LogActivities::insLogActivities('log headline successfully.');

        return redirect()->route('profile.index')->with('message', 'Berhasil mengubah headline profile.');
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
        $editProfile = Informasi::find($id);

        $getKategori = MasterKategori::where('flag_utama','=' ,'profile')->get();

        return view('backend/profile/edit', compact('editProfile', 'getKategori'));
    }

    public function view($id)
    {
        //
        $viewProfile = Informasi::find($id);

        $getKategori = MasterKategori::where('flag_utama','=' ,'profile')->get();

        return view('backend/profile/edit', compact('viewProfile', 'getKategori'));
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
        // dd($request->all());
        $messages = [
          'judul.required' => 'Tidak boleh kosong.',
          'kategoriId.required' => 'Tidak boleh kosong.',
          'isiKonten.required' => 'Tidak boleh kosong.',
          'kategoriId.not_in' => 'Pilih salah satu.',
        ];

        $validator = Validator::make($request->all(), [
                'judul' => 'required',
                'kategoriId' => 'required',
                'isiKonten' => 'required',
                'kategoriId' => 'required|not_in:-- Pilih --',
            ], $messages);

        if ($validator->fails()) {
            return redirect()->route('profile.edit', $request->id)->withErrors($validator)->withInput();
        }

        $setTglPosting = date('Y-m-d');
        $set = Informasi::find($request->id);
        $set->judul_informasi = $request->judul;
        $set->id_kategori = $request->kategoriId;
        $set->isi_informasi = $request->isiKonten;
        $set->tanggal_publish = $setTglPosting;
        $set->updated_by = Auth::user()->id;
        $set->save();

        \LogActivities::insLogActivities('log update successfully.');

        return redirect()->route('profile.index')->with('message', 'Berhasil mengubah profile.');
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
        $set = Informasi::find($id);
        if ($status == 'aktifkan') {
          $set->activated = 1;
        } else {
          $set->activated = 0;
        }
        $set->updated_by = Auth::user()->id;
        $set->save();

        \LogActivities::insLogActivities('log destroy successfully.');

        return redirect()->route('profile.index')->with('message', 'Berhasil mengubah status profile.');
    }
}
