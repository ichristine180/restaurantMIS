<?php

namespace App\Http\Controllers;
use Auth;
use App\Models\User;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\PasswordRequest;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Show the form for editing the profile.
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        $user = new User();
        $role = $user->userRole(Auth::User()->role);
        return view('profile.edit',compact('role'));
    }

    /**
     * Update the profile
     *
     * @param  \App\Http\Requests\ProfileRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProfileRequest $request)
    {
        auth()->user()->update($request->all());

        return back()->withStatus(__('Profile successfully updated.'));
    }

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

    public function postProfile(PasswordRequest $request){
        auth()->user()->update($request->all());

        return back()->withStatus(__('Profile successfully updated.'));
    }
}
