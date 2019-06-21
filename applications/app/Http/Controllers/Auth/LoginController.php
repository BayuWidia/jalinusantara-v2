<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Contracts\Auth\Guard;
use Carbon\Carbon;

use Validator;
use Auth;
use Session;
use Hash;

use App\Models\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request, Guard $auth)
    {

      // dd($request);
      $message = [
        'email.required' => 'Email Tidak Boleh Kosong',
        'password.required' => 'Password Tidak Boleh Kosong'
      ];

      $validator = Validator::make($request->all(), [
        'email' => 'required',
        'password' => 'required',
      ], $message);

      if($validator->fails()) {
        return redirect()->route('backend.login.index')->withErrors($validator)->withInput();
      }

      // dd(Hash::make($request->password));
      if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'activated' => '1'])) {
        $user = Auth::User();
        $set = User::find(Auth::user()->id);
        $getCounter = $set->login_count;
        $set->login_count = $getCounter+1;
        $set->save();

        // session()->put('id_role', Auth::user()->id_role);

        return redirect()->route('backend.dashboard');
      } else {
        return redirect()->route('backend.login.index')->with('failedLogin', 'Periksa Kembali Email atau Password Anda.')->withInput();
      }
    }

    public function logout()
    {
      session()->flush();
      Auth::logout();
      return redirect()->route('backend.login.index');
    }
}
