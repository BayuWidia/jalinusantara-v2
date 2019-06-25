<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Image;
use Validator;
use DB;
use App\Models\MasterProduct;
use App\Http\Requests;


class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('isAdmin');
    }

    public function index()
    {
        //
        $getProduct = MasterProduct::select('*')->orderby('id', 'desc')->get();
        return view('backend.product.kelolaproduct', compact('getProduct'));
    }


    public function store(Request $request)
    {
      // dd($request->all());
          // $messages = [
          //   'namaProduct.required' => 'Tidak boleh kosong.',
          //   'linkProduct.required' => 'Tidak boleh kosong.',
          //   'urlProduct.required' => 'Tidak boleh kosong.',
          //   'urlProduct.required' => 'Periksa kembali file image anda.',
          //   'urlProduct.image' => 'File upload harus image.',
          //   'urlProduct.mimes' => 'Ekstensi file tidak valid.',
          //   'urlProduct.max' => 'Ukuran file terlalu besar.',
          //   'keteranganProduct.required' => 'Tidak boleh kosong.',
          //   'activated.required' => 'Tidak boleh kosong.',
          // ];
          //
          // $validator = Validator::make($request->all(), [
          //         'namaProduct' => 'required',
          //         'linkProduct' => 'required',
          //         'keteranganProduct' => 'required',
          //         'activated' => 'required',
          //         'urlProduct' => 'required|image|mimes:jpeg,jpg,png|max:20000',
          //     ], $messages);
          //
          // if ($validator->fails()) {
          //     return redirect()->route('product.index')->withErrors($validator)->withInput();
          // }

          $file = $request->file('urlProduct');
          if($file!="") {
              $photoName = Auth::user()->email.'_'.time(). '.' . $file->getClientOriginalExtension();
              Image::make($file)->save('images/product/asli/'. $photoName);
              Image::make($file)->fit(188,126)->save('images/product/'. $photoName);

              $set = new MasterProduct;
              $set->nama_product = $request->namaProduct;
              $set->link_product = $request->linkProduct;
              $set->url_product = $photoName;
              $set->keterangan_product = $request->keteranganProduct;
              $set->flag_product = 1;
              $set->activated = $request->activated;
              $set->created_by = Auth::user()->id;
              $set->save();
          } else {
            return redirect()->route('product.index')->with('messagefail', 'Gambar Product harus di upload.');
          }

          \LogActivities::insLogActivities('log insert successfully.');

          return redirect()->route('product.index')->with('message', 'Berhasil memasukkan Product baru.');
    }

    public function show($id)
    {
        $set = MasterProduct::find($id);
        if($set->flag_product=="1") {
          $set->flag_product = 0;
        } elseif ($set->flag_product=="0") {
          $set->flag_product = 1;
        }
        $set->updated_by = Auth::user()->id;
        $set->save();

        \LogActivities::insLogActivities('log publish successfully.');

        return redirect()->route('product.index')->with('message', 'Berhasil mengubah publish Product.');
    }

    public function edit($id)
    {
        $get = MasterProduct::find($id);
        return $get;
    }

    public function update(Request $request)
    {
        // $messages = [
        //   'id.required' => 'Tidak boleh kosong.',
        //   'namaProductEdit.required' => 'Tidak boleh kosong.',
        //   'linkProductEdit.required' => 'Tidak boleh kosong.',
        //   'keteranganProductEdit.required' => 'Tidak boleh kosong.',
        // ];
        //
        // $validator = Validator::make($request->all(), [
        //         'id' => 'required',
        //         'namaProductEdit' => 'required',
        //         'linkProductEdit' => 'required',
        //         'keteranganProductEdit' => 'required',
        //     ], $messages);
        //
        // if ($validator->fails()) {
        //   // dd($validator);
        //     return redirect()->route('product.index')->withErrors($validator)->withInput();
        // }

        $set = MasterProduct::find($request->id);
        $set->nama_product = $request->namaProductEdit;
        $set->link_product = $request->linkProductEdit;
        $file = $request->file('urlProduct');
        if($file!="") {
          $photoName = Auth::user()->email.'_'.time(). '.' . $file->getClientOriginalExtension();
          Image::make($file)->save('images/product/asli/'. $photoName);
          Image::make($file)->fit(188,126)->save('images/product/'. $photoName);
          $set->url_product = $photoName;
        }
        $set->keterangan_product = $request->keteranganProductEdit;
        $set->updated_by = Auth::user()->id;
        $set->save();

        \LogActivities::insLogActivities('log update successfully.');

        return redirect()->route('product.index')->with('message', 'Berhasil mengubah konten Product.');
    }

    public function destroy($id, $status)
    {
        $set = MasterProduct::find($id);
        if ($status == 'aktifkan') {
          $set->activated = 1;
        } else {
          $set->activated = 0;
        }
        $set->updated_by = Auth::user()->id;
        $set->save();

        \LogActivities::insLogActivities('log destroy successfully.');

        return redirect()->route('product.index')->with('message', 'Berhasil mengubah status Product.');
    }
}
