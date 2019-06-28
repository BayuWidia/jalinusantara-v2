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

class ArticleController extends Controller
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
         return view('backend.article.index');
     }

     public function getDataForDataTable()
     {

       if (Auth::user()->id_role != 4) {
         $querys = Informasi::leftJoin('master_kategori','informasi.id_kategori','=','master_kategori.id')
             ->leftJoin('master_users','informasi.created_by','=','master_users.id')
             ->select(['informasi.id as id_informasi',
                       'informasi.judul_informasi', 'master_kategori.nama_kategori',
                       'informasi.tanggal_publish', 'master_users.fullname',
                       'informasi.flag_headline', 'informasi.flag_publish', 'informasi.activated'])
                       ->where('informasi.flag_status', '=', 'article')
                       ->orderBy('flag_publish', 'DESC')
                       ->orderBy('id_informasi', 'DESC');
       } else {
         $querys = Informasi::leftJoin('master_kategori','informasi.id_kategori','=','master_kategori.id')
             ->leftJoin('master_users','informasi.created_by','=','master_users.id')
             ->select(['informasi.id as id_informasi',
                       'informasi.judul_informasi', 'master_kategori.nama_kategori',
                       'informasi.tanggal_publish', 'master_users.fullname',
                       'informasi.flag_headline', 'informasi.flag_publish', 'informasi.activated'])
                       ->where('informasi.created_by', '=', Auth::user()->id)
                       ->where('informasi.flag_status', '=', 'article')
                       ->orderBy('flag_publish', 'DESC')
                       ->orderBy('id_informasi', 'DESC');
       }

                       // dd($querys);
       return Datatables::of($querys)
         ->addColumn('action', function($query){
             if ($query->flag_headline == "1") {
               $strHeadline = '<a href="#" class="btn bg-deep-purple btn-circle waves-effect waves-circle waves-float flagheadline"
                               data-toggle="modal" data-target="#modalflagheadline" data-value="'.$query->id_informasi.'"
                               data-backdrop="static" data-keyboard="false"><i class="material-icons">favorite</i></a>';
             } else {
               $strHeadline = '<a href="#" class="btn bg-blue-grey btn-circle waves-effect waves-circle waves-float flagheadline"
                                 data-toggle="modal" data-target="#modalflagheadline" data-value="'.$query->id_informasi.'"
                                 data-backdrop="static" data-keyboard="false"><i class="material-icons">favorite_border</i></a>';
             }

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

             $strUpd = '<a href="admin/article.edit/'.$query->id_informasi.'" class="btn btn-success btn-circle waves-effect waves-circle waves-float">
                           <i class="material-icons">open_in_new</i></a>';

             $strView = '<a href="admin/article.view/'.$query->id_informasi.'" class="btn btn-primary btn-circle waves-effect waves-circle waves-float">
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
         ->editColumn('tanggal_publish', function ($query)
         {
             return Carbon::parse($query->tanggal_publish)->format('d-m-Y');
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
        $getKategori = MasterKategori::where('flag_utama','=' ,'article')->get();
        return view('backend.article.tambah', compact('getKategori'));
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
        // dd($request->all());
        // $messages = [
        //   'judul.required' => 'Tidak boleh kosong.',
        //   'kategoriId.required' => 'Tidak boleh kosong.',
        //   'urlFoto.required' => 'Tidak boleh kosong.',
        //   'urlFoto.required' => 'Periksa kembali file image anda.',
        //   'urlFoto.image' => 'File upload harus image.',
        //   'urlFoto.mimes' => 'Ekstensi file tidak valid.',
        //   'urlFoto.max' => 'Ukuran file terlalu besar.',
        //   'isiKonten.required' => 'Tidak boleh kosong.',
        //   'kategoriId.not_in' => 'Pilih salah satu.',
        // ];
        //
        // $validator = Validator::make($request->all(), [
        //         'judul' => 'required',
        //         'kategoriId' => 'required',
        //         'isiKonten' => 'required',
        //         'kategoriId' => 'required|not_in:-- Pilih --',
        //         'urlFoto' => 'required|image|mimes:jpeg,jpg,png|max:40000',
        //     ], $messages);
        //
        // if ($validator->fails()) {
        //     return redirect()->route('article.tambah')->withErrors($validator)->withInput();
        // }

        // $file = $request->file('urlFoto');
        // if($file!="") {
        //   $photoName = Auth::user()->email.'_'.time(). '.' . $file->getClientOriginalExtension();
        //   Image::make($file)->save('images/article/asli/'. $photoName);
        //   Image::make($file)->fit(1000,589)->save('images/article/'. $photoName);

          $flagHeadline="";
          if($request->flagHeadline=="") {
            $flagHeadline=0;
          } else {
            $flagHeadline=1;
          }

          $setTglPosting = date('Y-m-d');
          $set = new Informasi;
          $set->judul_informasi = $request->judul;
          $set->id_kategori = $request->kategoriId;
          $file = $request->file('urlFoto');
          if($file!="") {
            $photoName = Auth::user()->email.'_'.time(). '.' . $file->getClientOriginalExtension();
            Image::make($file)->save('images/article/asli/'. $photoName);
            Image::make($file)->fit(1000,589)->save('images/article/'. $photoName);
            $set->url_foto = $photoName;
          }
          // $set->url_foto = $photoName;
          $set->isi_informasi = $request->isiKonten;
          $set->tags = $request->tags;
          $set->flag_headline = $flagHeadline;
          $set->tanggal_publish = $setTglPosting;
          $set->flag_status = 'article';
          $set->activated = 1;
          $set->view_counter = 0;
          $set->created_by = Auth::user()->id;
          $set->save();
        // } else {
        //   return redirect()->route('article.index')->with('messagefail', 'Gambar article harus di upload.');
        // }

        \LogActivities::insLogActivities('log insert successfully.');

        return redirect()->route('article.index')->with('message', 'Berhasil memasukkan article baru.');
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

        return redirect()->route('article.index')->with('message', 'Berhasil mengubah publish article.');
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

        return redirect()->route('article.index')->with('message', 'Berhasil mengubah headline article.');
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
        $editArticle = Informasi::find($id);

        $getKategori = MasterKategori::where('flag_utama','=' ,'article')->get();

        return view('backend/article/edit', compact('editArticle', 'getKategori'));
    }

    public function view($id)
    {
        //
        $viewArticle = Informasi::find($id);

        $getKategori = MasterKategori::where('flag_utama','=' ,'article')->get();

        return view('backend/article/edit', compact('viewArticle', 'getKategori'));
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
        // $messages = [
        //   'judul.required' => 'Tidak boleh kosong.',
        //   'kategoriId.required' => 'Tidak boleh kosong.',
        //   'isiKonten.required' => 'Tidak boleh kosong.',
        //   'kategoriId.not_in' => 'Pilih salah satu.',
        // ];
        //
        // $validator = Validator::make($request->all(), [
        //         'judul' => 'required',
        //         'kategoriId' => 'required',
        //         'isiKonten' => 'required',
        //         'kategoriId' => 'required|not_in:-- Pilih --',
        //     ], $messages);
        //
        // if ($validator->fails()) {
        //     return redirect()->route('article.edit', $request->id)->withErrors($validator)->withInput();
        // }

        $flagHeadline="";
        if($request->flagHeadline=="") {
          $flagHeadline=0;
        } else {
          $flagHeadline=1;
        }

        $setTglPosting = date('Y-m-d');
        $set = Informasi::find($request->id);
        $set->judul_informasi = $request->judul;
        $set->id_kategori = $request->kategoriId;
        $file = $request->file('urlFoto');
        if($file!="") {
          $photoName = Auth::user()->email.'_'.time(). '.' . $file->getClientOriginalExtension();
          Image::make($file)->save('images/article/asli/'. $photoName);
          Image::make($file)->fit(1000,589)->save('images/article/'. $photoName);
          $set->url_foto = $photoName;
        }
        $set->isi_informasi = $request->isiKonten;
        $set->tags = $request->tags;
        $set->flag_headline = $flagHeadline;
        $set->tanggal_publish = $setTglPosting;
        $set->updated_by = Auth::user()->id;
        $set->save();

        \LogActivities::insLogActivities('log update successfully.');

        return redirect()->route('article.index')->with('message', 'Berhasil mengubah article.');
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

        return redirect()->route('article.index')->with('message', 'Berhasil mengubah status article.');
    }
}
