<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use Auth;
use DB;
use Image;
use Validator;
use Carbon\Carbon;
use PDF;
use App\Models\User;
use App\Models\Events;
use App\Models\Informasi;
use Hash;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('isAdmin');
    }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Http\Response
   */
    public function index()
    {
        $getDataRole = DB::table('master_roles')->select('*')->orderBy('id', 'ASC')->get();
        $getDataUser = User::
          select('master_users.*', 'master_roles.nama_role')
          ->leftjoin('master_roles', 'master_users.id_role', '=', 'master_roles.id')
          ->orderby('master_users.name', 'asc')
          ->paginate(15);

        return view('backend.user.kelolauser', compact('getDataUser', 'getDataRole'));
    }

    public function search(Request $request)
  	{
  		// menangkap data pencarian
  		$search = $request->search;
      // mengambil data dari table pegawai sesuai pencarian data


      $getDataRole = DB::table('master_roles')->select('*')->orderBy('id', 'ASC')->get();
      $getDataUser = User::
        select('master_users.*', 'master_roles.nama_role')
        ->leftjoin('master_roles', 'master_users.id_role', '=', 'master_roles.id')
        ->where(strtolower('master_users.name'),'like',strtolower("%".$search."%"))
        ->orWhere(strtolower('master_users.fullname'), 'like', strtolower("%".$search."%"))
        ->orderby('master_users.name', 'asc')
        ->paginate(10);

      // mengirim data pegawai ke view index
  		return view('backend.user.kelolauser', compact('getDataUser', 'getDataRole'));

  	}

    public function store(Request $request)
    {
        $message = [
          'roleId.required' => 'Wajib di isi',
          'username.required' => 'Wajib di isi',
          'fullname.required' => 'Wajib di isi',
          'email.required' => 'Wajib di isi',
          'password.required' => 'Wajib di isi',
          'urlPhoto.image' => 'File upload harus image.',
          'urlPhoto.mimes' => 'Ekstensi file tidak valid.',
          'urlPhoto.max' => 'Ukuran file terlalu besar.'
        ];

        $validator = Validator::make($request->all(), [
          'roleId' => 'required',
          'username' => 'required',
          'fullname' => 'required',
          'email' => 'required',
          'password' => 'required',
          'urlPhoto' => 'image|mimes:jpeg,jpg,png|max:20000'
        ], $message);

        if($validator->fails()){
          return redirect()->route('user.index')->withErrors($validator)->withInput();
        }

        $checkdouble = User::where('email','=' ,$request->email)->get();

       if ($checkdouble != null) {
         return redirect()->route('user.index')->with('messagefail', 'Email sudah tersedia.');
       }

        $file = $request->file('urlPhoto');
        $photoName = '';
        if($file!="") {
        $photoName = Auth::user()->email.'_'.time(). '.' . $file->getClientOriginalExtension();
          Image::make($file)->fit(128,128)->save('images/user/'. $photoName);
        }

        $set = new User;
        $set->id_role = $request->roleId;
        $set->name = $request->username;
        $set->fullname = $request->fullname;
        $set->email = $request->email;
        $set->password = Hash::make($request->password);
        $set->login_count = 0;
        $set->url_foto = $photoName;
        $set->activated = 1;
        $set->created_by = Auth::user()->id;
        $set->save();

        \LogActivities::insLogActivities('log insert successfully.');

        return redirect()->route('user.index')->with('message', 'Berhasil memasukkan user baru.');
    }

    public function update(Request $request)
    {
      $message = [
        'roleId_edit.required' => 'Wajib di isi',
        'username_edit.required' => 'Wajib di isi',
        'fullname_edit.required' => 'Wajib di isi',
        'email_edit.required' => 'Wajib di isi',
        'urlPhoto_edit.image' => 'File upload harus image.',
        'urlPhoto_edit.mimes' => 'Ekstensi file tidak valid.',
        'urlPhoto_edit.max' => 'Ukuran file terlalu besar.'
      ];

      $validator = Validator::make($request->all(), [
        'roleId_edit' => 'required',
        'username_edit' => 'required',
        'fullname_edit' => 'required',
        'email_edit' => 'required',
        'urlPhoto_edit' => 'image|mimes:jpeg,jpg,png|max:20000'
      ], $message);

      if($validator->fails())
      {
        return redirect()->route('user.index')->withErrors($validator)->withInput();
      }

      // dd($request->all());

      $set = User::find($request->id);
      $set->id_role = $request->roleId_edit;
      $set->name = $request->username_edit;
      $set->fullname = $request->fullname_edit;
      $set->email = $request->email_edit;
      $file = $request->file('urlPhoto_edit');
      if($file!="") {
        $photoName = Auth::user()->email.'_'.time(). '.' . $file->getClientOriginalExtension();
        Image::make($file)->fit(128,128)->save('images/user/'. $photoName);
        $set->url_foto = $photoName;
      }
      $set->created_by = Auth::user()->id;
      $set->save();

      \LogActivities::insLogActivities('log insert successfully.');

      return redirect()->route('user.index')->with('message', 'Berhasil mengubah user.');
    }

    public function destroy($id, $status)
    {
        //
        $set = User::find($id);
        if ($status == 'aktifkan') {
          $set->activated = 1;
        } else {
          $set->activated = 0;
        }
        $set->updated_by = Auth::user()->id;
        $set->save();

        \LogActivities::insLogActivities('log destroy successfully.');

        return redirect()->route('user.index')->with('message', 'Berhasil mengubah status user.');
    }

    public function edit($id)
    {
      $get = User::find($id);
      return $get;
    }

    public function updPassword(Request $request)
    {
      $message = [
        'passwordPass.required' => 'Wajib di isi'
      ];

      $validator = Validator::make($request->all(), [
        'passwordPass' => 'required'
      ], $message);

      if($validator->fails()){
        return redirect()->route('user.index')->withErrors($validator)->withInput();
      }

      $set = User::find($request->id_pass);
      $set->password = Hash::make($request->passwordPass);
      $set->updated_by = Auth::user()->id;
      $set->save();

      \LogActivities::insLogActivities('log updated password successfully.');

      return redirect()->route('user.index')->with('message', 'Data tersebut telah diubah Password.');
    }

    public function profile()
    {
      $getDataUserById = User::
        select('master_users.*', 'master_roles.nama_role')
        ->leftjoin('master_roles', 'master_users.id_role', '=', 'master_roles.id')
       ->where('master_users.id', Auth::user()->id)
       ->first();

       $getCountEvents = Events::where('events.created_by', '=', Auth::user()->id)->count();
       $getCountInformasi = Informasi::where('informasi.created_by', '=', Auth::user()->id)->where('flag_status','=' ,'article')->count();


        return view('backend.user.profile', compact('getDataUserById','getCountEvents','getCountInformasi'));
    }

    public function updatepasswordByUser(Request $request)
    {

        $messages = [
          'username.required' => 'Tidak boleh kosong.',
          'fullname.required' => 'Tidak boleh kosong.',
          'oldpassword.required' => 'Password lama harus diisi.',
          'password.required' => 'Password baru harus diisi.',
          'password_confirmation.required' => 'Konfirmasi password baru harus diisi.',
          'password.confirmed' => 'Konfirmasi password tidak valid.',
        ];

        $validator = Validator::make($request->all(), [
          'username' => 'required',
          'fullname' => 'required',
          'oldpassword' => 'required',
          'password' => 'required|confirmed',
          'password_confirmation' => 'required'
        ], $messages);

      if($validator->fails())
      {
        return redirect()->route('user.profile')->withErrors($validator)->withInput();
      }

      $get = User::find($request->id);
      if(Hash::check($request->oldpassword, $get->password)) {
        $set = User::find($request->$id);
        $set->name = $request->username;
        $set->fullname = $request->fullname;
        $set->password = Hash::make($request->password);
        $set->updated_by = Auth::user()->id;
        $set->save();

        return redirect()->route('user.profile')->with('message', 'Data tersebut telah diubah.');
      } else {
        return redirect()->route('user.profile')->with('messagefail', 'Password lama tidak valid.');
      }
    }

}
