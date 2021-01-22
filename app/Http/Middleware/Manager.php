<?php

namespace App\Http\Middleware;
use Auth;
use App\Models\Role;
use Closure;
use Illuminate\Http\Request;

class Manager
{
    
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $userRoles = [];
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        foreach (Auth::User()->role as $role) {
           $roles= $role->pivot->role_id;
           $name= Role::find($roles)->name;
           array_push($userRoles, $name);
        }
        if(in_array('Manager',$userRoles)){
            return $next($request);
        }
        if(in_array('Managing Director',$userRoles)){
            return redirect()->route('home');
        }
        if(in_array('Supervisor',$userRoles)){
            return redirect()->route('supervisorHome');
        }
        if(in_array('Cashier',$userRoles)){
            return redirect()->route('cashierHome');
        }
        if(in_array('Waiter',$userRoles)){
            return redirect()->route('waiterHome');
        }
        return redirect()->route('logout');
    }



}
