<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Auth;
class UserController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\Models\User  $model
     * @return \Illuminate\View\View
     */
    public function index(User $model)
    {
        $user = new User();
        $role = $user->userRole(Auth::User()->role);
        $users = User::first()->paginate(5);
        return view('users.index', compact('users','role'))
        ->with('i', (request()->input('page', 1) - 1) * 5);
    }
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->back()->with('successMsg','Successfully Deleted');
    }
}
