<?php

namespace App\Http\Controllers;
use Auth;
use App\Models\User;
use App\Models\Orders;
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
       $payedOrders = Orders::where('status','=','paid')->count();
       $allOrders = Orders::get()->count();
       $nonPayedOrders = Orders::where('status','=','pending')->count();
       $archivedOrders = Orders::where('status','=','pending')->count();
       //dd($payedOrders);
        return view('waiterDashboard', compact('role','archivedOrders','nonPayedOrders','allOrders','payedOrders'));
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
