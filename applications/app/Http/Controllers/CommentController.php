<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Image;
use Validator;
use DB;
use App\Models\MasterComment;
use App\Models\MasterTanggapan;
use App\Models\MasterPesan;
use App\Http\Requests;

class CommentController extends Controller
{

    public function index()
    {
        $getComment = MasterComment::all();
        $getComment = MasterComment::leftJoin('informasi', 'master_comment.id_informasi', '=', 'informasi.id')
                        ->select('master_comment.*', 'informasi.judul_informasi')
                        ->orderby('master_comment.created_at','desc')
                        ->get();
        return view('backend.comment.kelolacomment', compact('getComment'));
    }

    public function indexContact()
    {
        $getContact = MasterPesan::all();
        return view('backend.comment.kelolacontact', compact('getContact'));
    }


    public function store(Request $request)
    {
      // dd($request->all());
          // $messages = [
          //   'email.required' => 'Tidak boleh kosong.',
          //   'nama.required' => 'Tidak boleh kosong.',
          //   'subject.required' => 'Tidak boleh kosong.',
          //   'message.required' => 'Tidak boleh kosong.',
          // ];
          //
          // $validator = Validator::make($request->all(), [
          //         'email' => 'required',
          //         'nama' => 'required',
          //         'subject' => 'required',
          //         'message' => 'required',
          //     ], $messages);
          //
          // if ($validator->fails()) {
          //     return redirect()->route('articleById', ['id' => $request->id, 'idKategori' => $request->idKategori])->withErrors($validator)->withInput();
          // }

          $set = new MasterComment;
          $set->id_informasi = $request->id;
          $set->email = $request->email;
          $set->nama = $request->nama;
          $set->subject = $request->subject;
          $set->message = $request->message;
          $set->flag_comment = 0;
          $set->flag_tanggapan = 0;
          $set->activated = 1;
          $set->created_by = $request->email;
          $set->save();

          // \LogActivities::insLogActivities('log insert successfully.');

          return redirect()->route('articleById', ['id' => $request->id, 'idKategori' => $request->idKategori])->with('message', 'Berhasil memasukkan pesan anda.');
    }


    public function edit($id)
    {
        // $get = MasterComment::find($id);
        $get = MasterComment::leftjoin('master_tanggapan', 'master_comment.id', '=', 'master_tanggapan.id_comment')
                        ->select('master_comment.*', 'master_tanggapan.tanggapan','master_tanggapan.id as id_tanggapan')
                        ->where('master_comment.id','=',$id)
                        ->get();
        return $get;
    }

    public function show($id)
    {
        $set = MasterComment::find($id);
        if($set->flag_comment=="1") {
          $set->flag_comment = 0;
        } elseif ($set->flag_comment=="0") {
          $set->flag_comment = 1;
        }
        $set->updated_by = Auth::user()->id;
        $set->save();

        \LogActivities::insLogActivities('log publish successfully.');

        return redirect()->route('comment.index')->with('message', 'Berhasil mengubah publish comment.');
    }

    public function showContact($id)
    {
        $set = MasterPesan::find($id);
        if($set->flag_pesan=="1") {
          $set->flag_pesan = 0;
        } elseif ($set->flag_pesan=="0") {
          $set->flag_pesan = 1;
        }
        $set->updated_by = Auth::user()->id;
        $set->save();

        \LogActivities::insLogActivities('log publish successfully.');

        return redirect()->route('contact.index')->with('message', 'Berhasil mengubah publish message.');
    }

    public function storeTanggapan(Request $request)
    {
      // dd($request->all());
          $messages = [
            'tanggapan.required' => 'Tidak boleh kosong.',
          ];

          $validator = Validator::make($request->all(), [
                  'tanggapan' => 'required',
              ], $messages);

          if ($validator->fails()) {
              return redirect()->route('comment.index')->withErrors($validator)->withInput();
          }

          DB::transaction(function() use($request) {

            $set = new MasterTanggapan;
            $set->id_comment = $request->idComment;
            $set->tanggapan = $request->tanggapan;
            $set->activated = 1;
            $set->created_by = Auth::user()->id;
            $set->save();

            $set = MasterComment::find($request->idComment);
            $set->flag_tanggapan = 1;
            $set->updated_by = Auth::user()->id;
            $set->save();

          });

          \LogActivities::insLogActivities('log insert successfully.');

          return redirect()->route('comment.index')->with('message', 'Berhasil memasukkan tanggapan anda.');
    }

    public function storeContact(Request $request)
    {
      // dd($request->all());
          $messages = [
            'email.required' => 'Tidak boleh kosong.',
            'nama.required' => 'Tidak boleh kosong.',
            'subject.required' => 'Tidak boleh kosong.',
            'message.required' => 'Tidak boleh kosong.',
            'telephone.required' => 'Tidak boleh kosong.',
          ];

          $validator = Validator::make($request->all(), [
                  'email' => 'required',
                  'nama' => 'required',
                  'subject' => 'required',
                  'message' => 'required',
                  'telephone' => 'required',
              ], $messages);

          if ($validator->fails()) {
              return redirect()->route('contact')->withErrors($validator)->withInput();
          }

          $set = new MasterPesan;
          $set->email = $request->email;
          $set->nama = $request->nama;
          $set->subject = $request->subject;
          $set->telepon = $request->telephone;
          $set->isi = $request->message;
          $set->flag_pesan = 0;
          $set->activated = 1;
          $set->created_by = $request->email;
          $set->save();

          // \LogActivities::insLogActivities('log insert successfully.');

          return redirect()->route('contact')->with('message', 'Berhasil memasukkan pesan anda.');
    }

}
