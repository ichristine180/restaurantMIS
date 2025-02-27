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
    public function __construct()
    {
        $this->middleware('auth');
    }

    
    public function showRegistrationForm ()
    {
        $user = new User();
        $role = $user->userRole(Auth::User()->role);
        $isWaiter = $user->hasWaiter(Auth::User()->role);
        $listofRoles = '';
        if($role != 'Managing Director'){
            $listofRoles =DB::table('roles')->Where('name','!=','Managing Director')->get();
            }else{
                $listofRoles =DB::table('roles')->get();
            }
        return view('auth.register', compact('role','listofRoles','isWaiter'));
    }

    
    public function showEdit ($id)
    {
        $user = new User();
        $role = $user->userRole(Auth::User()->role);
        $isWaiter = $user->hasWaiter(Auth::User()->role);
        $user =User::find($id);
        $listofRoles = '';
        // dd($user);
        if($role != 'Managing Director'){
        $listofRoles =DB::table('roles')->Where('name','!=','Managing Director')->get();
        }else{
            $listofRoles =DB::table('roles')->get();
        }
    // dd($roles);
        return view('auth.edit', compact('role','listofRoles','user','isWaiter'));
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
    public function putUpdate(Request $request){
        $user = User::find(request('id'));
                $user->name=request('fname');
                $user->username=request('lname');
                $user->email=request('email');
                $request->validate([
                    'name' => 'required',
                    'username' => 'required|min:4',
                    'email' => 'required|email',
                    'role' => 'required'],
                    [
                    'username.min' =>'username should be atleast 4 charcters',
                ]
                    );
            $emailFound = DB::table('users')->where([['email', '=',$user->email],['id', '!=', $user->id]])->first();
            $usernamefound = DB::table('users')->where([['username', '=',$user->username],['id', '!=', $user->id]])->first();;
            //dd( $phoneNumberFound);
            if(!$emailFound && !$usernamefound){
               $updated = $user->update($request->all());
                if($updated){
            // $data1 = ['user_id'=>$user->id,'role_id'=>$data['role']];
            // $role_user =  DB::table('role_user')->insert($data1);
            return redirect('employees')->withStatus(__('Updated successfully.'));
        }
    }
    return back()->withError(__('oops! username or email is not available.'));
    }

    public function addRole ($id)
    {
        $user = new User();
        $role = $user->userRole(Auth::User()->role);
        $isWaiter = $user->hasWaiter(Auth::User()->role);
        $user =User::find($id);
        $exitRole = $user->userRole($user->role);
        $listofRoles = '';
        //  dd($exitRole);
        if($exitRole == 'Managing Director'){
        $listofRoles =DB::table('roles')->Where('name','!=','Managing Director')->Where('name','!=','Cashier')->get();
        }
        if($exitRole == 'Manager'){
            $listofRoles =DB::table('roles')->Where('name','=','Waiter')->orWhere('name','=','Supervisor')->get();
        }
    // dd($listofRoles);
        return view('users.addRole', compact('role','listofRoles','user','isWaiter'));
    }

    protected function PostAddRole(Request $request)
    {
        request()->validate([
            'role' => ['required', 'string'],
        ],
            [
            'role.required' =>'please select Role',
        ]
            );
            $data = $request->all();
       $checkRole = DB::table('role_user')->where('role_id','=',$data['role'])
       ->where('user_id','=',$data['id'])->get();
    //    dd( $checkRole->count());
        if($checkRole->count() == 0){
            $data1 = ['user_id'=>$data['id'],'role_id'=>$data['role']];
            $role_user =  DB::table('role_user')->insert($data1);
            return redirect('employees')->withStatus(__('role added successfully.'));
        }
        return back()->withError(__('oops! has already that role.'));
    }
}