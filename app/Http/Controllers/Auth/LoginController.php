<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use Session;
use Validator,Redirect,Response;
class LoginController extends Controller
{

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
    public function postLogin(Request $request)
    {
        request()->validate([
        'username' => 'required',
        'password' => 'required',
        ]);
 
        $credentials = array_merge($request->only('username', 'password'));
        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return Redirect:: to('/home');
        }
        return Redirect::to("login")->withStatusLogin(__('Access Denied provide valid crendetials.'));
    }
    public function logout() {
        Session::flush();
        Auth::logout();
        return redirect(\URL::previous());
    }
}
