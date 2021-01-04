<?php

namespace App\Http\Controllers;
use Auth;
use App\Models\User;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $user = new User();
        $role = $user->userRole(Auth::User()->role);
        return view('dashboard', compact('role'));
    }
    
}
