<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Tables;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Auth;
class WaiterController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\Models\User  $model
     * @return \Illuminate\View\View
     */
    public function tables()
    {
        $user = new User();
        $role = $user->userRole(Auth::User()->role);
        // $tables = Tables::first();
        return view('waiter.tables', compact('role'))
        ->with('i');
    }
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->back()->with('successMsg','Successfully Deleted');
    }
}
