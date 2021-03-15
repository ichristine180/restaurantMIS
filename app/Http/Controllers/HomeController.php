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
        $isWaiter = $user->hasWaiter(Auth::User()->role);
        return view('dashboard', compact('role','isWaiter'));
    }
    public function waiterHome()
    {
        $user = new User();
        $role = $user->userRole(Auth::User()->role);
        $isWaiter = $user->hasWaiter(Auth::User()->role);
       $payedOrders = Orders::where('status','=','paid')
       ->where('userId','=',Auth::user()->id)
       ->count();
       $allOrders = Orders::get()
       ->count();
       $nonPayedOrders = Orders::where('status','=','pending')
       ->where('userId','=',Auth::user()->id)
       ->count();
       $archivedOrders = Orders::where('status','=','archived')
       ->where('userId','=',Auth::user()->id)
       ->count();
       //dd($payedOrders);
        return view('waiterDashboard', compact('role','archivedOrders','nonPayedOrders',
        'allOrders','payedOrders','isWaiter'));
    }
    public function cashierHome()
    {
        $user = new User();
        $role = $user->userRole(Auth::User()->role);
        $isWaiter = $user->hasWaiter(Auth::User()->role);
        $payedOrders = Orders::where('status','=','paid')
      
        ->count();
        $allOrders = Orders::get()
        ->count();
        $nonPayedOrders = Orders::where('status','=','pending')
       
        ->count();
        $archivedOrders = Orders::where('status','=','archived')
       
        ->count();
        //dd($payedOrders);
         return view('CashierDashboard', compact('role','archivedOrders','nonPayedOrders',
         'allOrders','payedOrders','isWaiter'));
       
    }
    public function managerHome()
    {
        $user = new User();
        $role = $user->userRole(Auth::User()->role);
        $isWaiter = $user->hasWaiter(Auth::User()->role);
        return view('Managerdashboard', compact('role','isWaiter'));
    }
    public function supervisorHome()
    {
        $user = new User();
        $role = $user->userRole(Auth::User()->role);
        $isWaiter = $user->hasWaiter(Auth::User()->role);
        $payedOrders = Orders::where('status','=','paid')
      
        ->count();
        $allOrders = Orders::get()
        ->count();
        $nonPayedOrders = Orders::where('status','=','pending')
       
        ->count();
        $archivedOrders = Orders::where('status','=','archived')
       
        ->count();
        //dd($payedOrCaders);
         return view('superVisorDashboard', compact('role','archivedOrders','nonPayedOrders',
         'allOrders','payedOrders','isWaiter'));
       // return view('superVisorDashboard', compact('role','isWaiter'));
    }
}
