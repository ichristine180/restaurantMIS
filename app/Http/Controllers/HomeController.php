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
    public function waiterHome()
    {
        $user = new User();
        $role = $user->userRole(Auth::User()->role);
       
        return view('waiterDashboard', compact('role'));
    }
    public function cashierHome()
    {
        $user = new User();
        $role = $user->userRole(Auth::User()->role);
        return view('cashierDashboard', compact('role'));
    }
    public function managerHome()
    {
        $user = new User();
        $role = $user->userRole(Auth::User()->role);
        return view('Managerdashboard', compact('role'));
    }
    public function supervisorHome()
    {
        $user = new User();
        $role = $user->userRole(Auth::User()->role);
        return view('superVisorDashboard', compact('role'));
    }
}
