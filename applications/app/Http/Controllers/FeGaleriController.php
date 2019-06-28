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
                                            ->orderby('master_video.id','DESC')
                                            ->get();

        return view('frontend.galeri.video', compact('getVideo'));
    }

    public function showPhoto()
    {
        $getPhoto = MasterGaleri::leftJoin('events','master_galeri.id_events','=','events.id')
                                ->select('master_galeri.*','events.judul_event')
                                ->where('master_galeri.flag_gambar', 1)
                                ->orderby('master_galeri.id','DESC')
                                ->get();
// dd($getPhoto);
        return view('frontend.galeri.photo', compact('getPhoto'));
    }

    public function postPhoto(Request $request)
    {
        $output = '';
        $getPhoto = MasterGaleri::leftJoin('events','master_galeri.id_events','=','events.id')
                                ->select('master_galeri.*','events.judul_event')
                                ->where('master_galeri.flag_gambar', 1)
                                ->orderby('master_galeri.id','DESC')
                                ->get();

        if (!$getPhoto->isEmpty())
        {
            foreach($getPhoto as $key)
            {
                $temp = '';
                if ($key->id_events == $temp) {
                  // code...
                  $output .= '<div class="col-12 col-sm-3">
                                <div class="wow fadeInUp" data-wow-delay="300ms">
                                    <a href="images/galeri/asli/"'.$key->url_gambar.'" class="single-gallery-item">
                                      <img src="images/galeri/asli/"'.$key->url_gambar.'" alt=""></a>
                                </div>
                                <br>
                            </div>';
                } else {
                  // code...
                  $output .= '<div class="col-12">
                                <div class="single-schedule-area wow fadeInUp" data-wow-delay="300ms">
                                    <!-- Single Schedule Thumb and Info -->
                                    <h3>'.$key->judul_event.'</h3>
                                </div>
                              </div>
                              <div class="col-12 col-sm-3">
                                  <div class="wow fadeInUp" data-wow-delay="300ms">
                                      <a href=""images/galeri/asli/"'.$key->url_gambar.'" class="single-gallery-item">
                                        <img src=""images/galeri/asli/"'.$key->url_gambar.'" alt=""></a>
                                  </div>
                                  <br>
                              </div>';
                }
                $temp = $key->id_events;
            }

            $output .= '<div class="row" id="remove-row">
                          <div class="col-12">
                              <div class="more-blog-btn text-center">
                                  <a class="btn confer-btn" id="loadmore" href="#">Load more <i class="zmdi zmdi-refresh"></i></a>
                              </div>
                          </div>
                      </div>';

            echo $output;
        }
    }

}
