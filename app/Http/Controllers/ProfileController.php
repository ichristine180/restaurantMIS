<?php

namespace App\Http\Controllers;
use Auth;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\PasswordRequest;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Change the password
     *
     * @param  \App\Http\Requests\PasswordRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function password(PasswordRequest $request)
    {
        auth()->user()->update(['password' => Hash::make($request->get('password'))]);

        return back()->withStatusPassword(__('Password successfully updated.'));
    }

    public function profile(){
        $user = new User();
        $role = $user->userRole(Auth::User()->role);
        return view('profile/Profile',compact('role'));
    }
    public function changePassword(){
        $user = new User();
        $role = $user->userRole(Auth::User()->role);
        return view('profile/edit',compact('role'));
    }
    public function postProfile(Request $request){
                $id = Auth::User()->id;
                $user = User::find($id);
                $user->username=request('username');
                $user->email=request('email');
                $user->save();
        return back()->withStatus(__('Profile successfully updated.'));
    }
   
}
