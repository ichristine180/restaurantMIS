<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use DB;
use Auth;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{

    public function showRegistrationForm ()
    {
        $user = new User();
        $role = $user->userRole(Auth::User()->role);
        $listofRoles =DB::table('roles')->get();
    // dd($roles);
        return view('auth.register', compact('role','listofRoles'));
    }
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function registerEmployee(Request $request)
    {
        request()->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'username' => ['required', 'string', 'min:4','unique:users'],
            'role' => ['required', 'string'],
        ],
            [
            'name.required' =>'Names are Required',
            'email.required' =>'email is Required',
            'role.required' =>'please select Role',
            'username.required' =>'username is required',
            'username.min' =>'Username must be at least 4 charcters',
            'username.unique' =>'username not available'
        ]
            );
            $data = $request->all();
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'username' => $data['username'],
            'password' => Hash::make('pass'),
        ]);
        if($user != null){
            $data1 = ['user_id'=>$user->id,'role_id'=>$data['role']];
            $role_user =  DB::table('role_user')->insert($data1);
            return redirect('employees')->withStatus(__('Registered successfully.'));
        }
        return back()->withError(__('oops! not Registered.'));
    }
}
