<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Image;
use Validator;
use DB;
use App\Models\MasterSlider;
use App\Http\Requests;

class SliderController extends Controller
{

    public function __construct()
    {
        $this->middleware('isAdmin');
    }

    public function index()
    {
          $getSlider = DB::table('master_slider')->paginate(15);
          return view('backend.slider.kelolaslider', compact('getSlider'));
    }

    public function store(Request $request)
    {
      // dd($request->all());
          // $messages = [
          //   'judul.required' => 'Tidak boleh kosong.',
          //   'urlSlider.required' => 'Tidak boleh kosong.',
          //   'urlSlider.required' => 'Periksa kembali file image anda.',
          //   'urlSlider.image' => 'File upload harus image.',
          //   'urlSlider.mimes' => 'Ekstensi file tidak valid.',
          //   'urlSlider.max' => 'Ukuran file terlalu besar.',
          //   'keteranganSlider.required' => 'Tidak boleh kosong.',
          //   'activated.required' => 'Tidak boleh kosong.',
          // ];
          //
          // $validator = Validator::make($request->all(), [
          //         'judul' => 'required',
          //         'keteranganSlider' => 'required',
          //         'activated' => 'required',
          //         'urlSlider' => 'required|image|mimes:jpeg,jpg,png|max:50000',
          // ], $messages);
          //
          // if ($validator->fails()) {
          //     return redirect()->route('slider.index')->withErrors($validator)->withInput();
          // }

          $file = $request->file('urlSlider');
          if($file!="") {
              $photoName = Auth::user()->email.'_'.time(). '.' . $file->getClientOriginalExtension();
              Image::make($file)->fit(1920,900)->save('images/slider/'. $photoName);
              Image::make($file)->fit(200,122)->save('_thumbs/slider/'. $photoName);

              $set = new MasterSlider;
              $set->judul = $request->judul;
              $set->url_slider = $photoName;
              $set->keterangan_slider = $request->keteranganSlider;
              $set->flag_slider = 1;
              $set->activated = $request->activated;
              $set->created_by = Auth::user()->id;
              $set->updated_by = Auth::user()->id;
              $set->save();
          } else {
            return redirect()->route('slider.index')->with('messagefail', 'Gambar slider harus di upload.');
          }

          \LogActivities::insLogActivities('log insert successfully.');

          return redirect()->route('slider.index')->with('message', 'Berhasil memasukkan slider baru.');
    }

    public function show($id)
    {
        $set = MasterSlider::find($id);
        if($set->flag_slider=="1") {
          $set->flag_slider = 0;
        } elseif ($set->flag_slider=="0") {
          $set->flag_slider = 1;
        }

        $set->updated_by = Auth::user()->id;
        $set->save();

        \LogActivities::insLogActivities('log publish successfully.');

        return redirect()->route('slider.index')->with('message', 'Berhasil mengubah publish slider.');
    }

    public function edit($id)
    {
        $get = MasterSlider::find($id);
        return $get;
    }

    public function update(Request $request)
    {
      // dd($request->all());
        $messages = [
          'id.required' => 'Tidak boleh kosong.',
          'judul.required' => 'Tidak boleh kosong.',
          'keteranganSlider.required' => 'Tidak boleh kosong.',
        ];

        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'judul' => 'required',
            'keteranganSlider' => 'required',
        ], $messages);

        if ($validator->fails()) {
            return redirect()->route('slider.index')->withErrors($validator)->withInput();
        }

        // dd($request);
        $set = MasterSlider::find($request->id);
        $set->judul = $request->judul;
        $file = $request->file('urlSliderEdit');
        if($file!="") {
          $photoName = Auth::user()->email.'_'.time(). '.' . $file->getClientOriginalExtension();
          Image::make($file)->fit(1920,900)->save('images/slider/'. $photoName);
          Image::make($file)->fit(200,122)->save('_thumbs/slider/'. $photoName);
          $set->url_slider = $photoName;
        }
        $set->keterangan_slider = $request->keteranganSlider;
        $set->updated_by = Auth::user()->id;
        $set->save();

        \LogActivities::insLogActivities('log update successfully.');

        return redirect()->route('slider.index')->with('message', 'Berhasil mengubah konten slider.');
    }

    public function destroy($id, $status)
    {
        //
        $set = MasterSlider::find($id);
        if ($status == 'aktifkan') {
          $set->activated = 1;
        } else {
          $set->activated = 0;
        }
        $set->updated_by = Auth::user()->id;
        $set->save();

        \LogActivities::insLogActivities('log destroy successfully.');

        return redirect()->route('slider.index')->with('message', 'Berhasil mengubah status slider.');
    }
}
