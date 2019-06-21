<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Image;
use Validator;
use DB;
use App\Models\Informasi;
use App\Models\MasterSlider;
use App\Models\MasterSponsor;
use App\Http\Requests;

class FeAboutController extends Controller
{

    public function index($id)
    {
          $getSlider = MasterSlider::all();
          $getInformasi = Informasi::join('master_kategori', 'informasi.id_kategori', '=', 'master_kategori.id')
                          ->select(DB::raw('distinct(master_kategori.nama_kategori)'), 'informasi.*')
                          ->where('informasi.id','=',$id)->get();
          return view('frontend.about.about', compact('getInformasi','getSlider'));
    }

}
