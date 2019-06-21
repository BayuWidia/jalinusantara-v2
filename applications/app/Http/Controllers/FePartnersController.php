<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Image;
use Validator;
use DB;
use App\Models\MasterPartners;
use App\Models\MasterSlider;
use App\Models\Events;
use App\Models\MasterSertifikat;
use App\Http\Requests;

class FePartnersController extends Controller
{
    public function showPartners()
    {
        $getSlider = MasterSlider::all();
        $getPartners = MasterPartners::select('*')
                                ->where('flag_partners', 1)
                                ->get();
        $getSertifikatPortrait = MasterSertifikat::select('master_sertifikat.*')
                      ->where('flag_sertifikat', 1)
                      ->where('format_sertifikat', 'P')
                      ->orderby(DB::raw('rand()'))
                      ->get();
        $getSertifikatLandscape = MasterSertifikat::select('master_sertifikat.*')
                      ->where('flag_sertifikat', 1)
                      ->where('format_sertifikat', 'L')
                      ->orderby(DB::raw('rand()'))
                      ->get();

        return view('frontend.partners.partners', compact('getSlider','getPartners','getSertifikatPortrait','getSertifikatLandscape'));
    }

}
