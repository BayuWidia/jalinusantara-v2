<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Image;
use Validator;
use DB;
use App\Models\MasterGaleri;
use App\Models\MasterSlider;
use App\Http\Requests;
// use Cornford\Googlmapper\Facades\MapperFacade as Mapper;

class FeContactController extends Controller
{

    public function index()
    {
          // Mapper::map(-6.143693, 106.902062); 40.6700, -73.9400
          return view('frontend.contact.contact');
    }

}
