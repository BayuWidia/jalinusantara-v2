<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Image;
use Validator;
use DB;
use App\Models\MasterGaleri;
use App\Models\MasterVideo;
use App\Models\MasterSlider;
use App\Models\Events;
use App\Http\Requests;

class FeGaleriController extends Controller
{

    public function showVideo()
    {
        $getVideo = MasterVideo::leftJoin('events','master_video.id_events','=','events.id')
                                            ->select('master_video.*','events.judul_event')
                                            ->where('master_video.flag_video', 1)
                                            ->orderby('master_video.id_events','ASC')
                                            ->get();

        return view('frontend.galeri.video', compact('getVideo'));
    }

    public function showPhoto()
    {
        $getPhoto = MasterGaleri::leftJoin('events','master_galeri.id_events','=','events.id')
                                ->select('master_galeri.*','events.judul_event')
                                ->where('master_galeri.flag_gambar', 1)
                                ->orderby('master_galeri.id_events','ASC')
                                ->get();
// dd($getPhoto);
        return view('frontend.galeri.photo', compact('getPhoto'));
    }

}
