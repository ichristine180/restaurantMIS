<?php

namespace App\Http\Controllers;
use DB;
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
         $table = Tables::first()->simplePaginate(4);
         //dd($tables);
        return view('waiter.tables', compact('role','table'))
        ->with('i',(request()->input('page', 1) - 1) * 4);
    }
    public function create(){
        $code;
        $tableList =DB::table('tables')->orderBy('id', 'DESC')->first();
        if($tableList == null){
            $this->code = Tables::generateCode(1);
            //dd($this->code);
               }else{
                   $id = $tableList->id;
                   $id = $id+1;
                   $this->code = Tables::generateCode($id);
                   //dd($this->registrationNumber);
               }
       
       $tables = new Tables();
       $tables->code = $this->code;
       $tables->save();
       return redirect()->back()->with('successMsg','Tables with tableNumber:'.$this->code.' created successful');

    }
    public function destroy($id)
    {
        $tables = Tables::find($id);
        $tables->delete();
        return redirect()->back()->with('successMsg','Successfully Deleted');
    }
}
