<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use Session;
use App\Models\User;
use App\Models\Role;
use Validator,Redirect,Response;
class LoginController extends Controller
{

    use AuthenticatesUsers;

     protected $redirectTo;
     

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function redirectTo()
    {
        $roles = Auth::User()->role;
        $userRoles = [];
        foreach ($roles as $role) {
           $users= $role->pivot->role_id;
           $name= Role::find($users)->name;
           array_push($userRoles, $name);
        }
     if(in_array('Managing Director',$userRoles)){
            $this->redirectTo = '/home';
                return $this->redirectTo;
 }
     if(in_array('Manager',$userRoles)){
    $this->redirectTo = '/managerHome';
        return $this->redirectTo;
}
     if(in_array('SuperVisor',$userRoles)){
    $this->redirectTo = '/superVisorHome';
        return $this->redirectTo;
}
     if(in_array('Cashier',$userRoles)){
    $this->redirectTo = '/cashierHome';
        return $this->redirectTo;
}
if(in_array('Waiter',$userRoles)){
    $this->redirectTo = '/waiterHome';
        return $this->redirectTo;
}
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
            return Redirect:: to($this->redirectTo());
        }
        return Redirect::to("login")->withStatusLogin(__('Access Denied provide valid crendetials.'));
    }
    public function logout() {
        Session::flush();
        Auth::logout();
        return redirect(\URL::previous());
    }
}
