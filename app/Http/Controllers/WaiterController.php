<?php

namespace App\Http\Controllers;
use DB;
use App\Models\User;
use App\Models\Tables;
use App\Models\Orders;
use App\Item;
use DataTables;
use Illuminate\Http\Request;
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
        $isWaiter = $user->hasWaiter(Auth::User()->role);
         $table = Tables::latest()->get();
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
    public function orders()
    {
        $user = new User();
        $role = $user->userRole(Auth::User()->role);
        $isWaiter = $user->hasWaiter(Auth::User()->role);
       
        return view('waiter.orders', compact('role','isWaiter'));
    }

    public function ordersList(Request $request)
    {
        if ($request->ajax()) {
            $model = Orders::with(['item','tables','user']);
                return DataTables::eloquent($model)
                ->addIndexColumn()
                ->editColumn('created_at', function ($orders) 
                {
    //change over here
               return date('m-d H', strtotime($orders->created_at) );
                  })
                ->addColumn('name',function (Orders $orders) {
                    return $orders->item->name;
                })
                ->addColumn('price',function (Orders $orders) {
                    return $orders->item->price;
                })
                ->addColumn('code',function (Orders $orders) {
                    return $orders->tables->code;
                })
                ->addColumn('username',function (Orders $orders) {
                    return $orders->user->name;
                })
                ->toJson();
                return date('d-m-Y', strtotime($orders->created_at) );
        }
        return view('waiter.orders');
    }
    public function nonPayed(Request $request){
        if ($request->ajax()) {
            $model = Orders::with(['item','tables','user'])->where('status','=','pending')
            ->where('userId','=',Auth::user()->id)
            ->orderBy('created_at', 'DESC');
                return DataTables::eloquent($model)
                ->editColumn('created_at', function ($orders) 
                {
    //change over here
               return date('m-d H', strtotime($orders->created_at) );
                  })
                ->addIndexColumn()
                ->addColumn('name',function (Orders $orders) {
                    return $orders->item->name;
                })
                ->addColumn('price',function (Orders $orders) {
                    return $orders->item->price;
                })
                ->addColumn('code',function (Orders $orders) {
                    return $orders->tables->code;
                })
                ->addColumn('username',function (Orders $orders) {
                    return $orders->user->name;
                })
                ->toJson();
        }
        return view('waiterDashboard');
    }
    public function paidList(Request $request){
        if ($request->ajax()) {
            $model = Orders::with(['item','tables','user'])->where('status','=','paid')
          ;
                return DataTables::eloquent($model)
                
                ->addIndexColumn()
                ->editColumn('created_at', function ($orders) 
                {
    //change over here
               return date('m-d H', strtotime($orders->created_at) );
                  })
                ->addColumn('name',function (Orders $orders) {
                    return $orders->item->name;
                })
                ->addColumn('price',function (Orders $orders) {
                    return $orders->item->price;
                })
                ->addColumn('code',function (Orders $orders) {
                    return $orders->tables->code;
                })
                ->toJson();
                return date('d-m-Y', strtotime($orders->created_at) );
        }
        return view('waiter.Paid');
    }
    public function paid()
    {
        $user = new User();
        $role = $user->userRole(Auth::User()->role);
        $isWaiter = $user->hasWaiter(Auth::User()->role);
        return view('waiter.Paid', compact('role','isWaiter'));
    }
    public function archived()
    {
        $user = new User();
        $role = $user->userRole(Auth::User()->role);
        $isWaiter = $user->hasWaiter(Auth::User()->role);
        return view('waiter.Archived', compact('role','isWaiter'));
       
    }
    public function archivedList(Request $request){
        if ($request->ajax()) {
            $model = Orders::with(['item','tables','user'])->where('status','=','archived')
            ->where('userId','=',Auth::user()->id);
                return DataTables::eloquent($model)
                ->addIndexColumn()
                ->editColumn('created_at', function ($orders) 
                {
    //change over here
               return date('m-d H', strtotime($orders->created_at) );
                  })
                ->addColumn('name',function (Orders $orders) {
                    return $orders->item->name;
                })
                ->addColumn('price',function (Orders $orders) {
                    return $orders->item->price;
                })
                ->addColumn('code',function (Orders $orders) {
                    return $orders->tables->code;
                })
                ->toJson();
                
        }
        return view('waiter.Archived');
    }
    public function createOrders(){
        $user = new User();
        $role = $user->userRole(Auth::User()->role);
        $table = Tables::get();
        $items = Item::get();
       
        return view('waiter.create', compact('role','items','table'));
    }
    public function postOrders(Request $request){
        request()->validate([
            'item' => ['required'],
            'table' => ['required'],
            'quantity' => ['required'],
        ],
            );
            $data = $request->all();
            $discount;
            if($request->discount == null){
                $discount = 0;
            }else{
                $discount = $request->discount;
            }
            $ammount = Item::find($data['item'])->price*$data['quantity'] -$discount;
            //dd($ammount);
            $orders = Orders::create([
                'tablesId' => $data['table'],
                'itemId' => $data['item'],
                'quantity' => $data['quantity'],
                'status' => 'pending',
                'userId' => Auth::user()->id,
                'discount'=> $discount,
                'ammount'=> $ammount
            ]);

            if($orders != null){
                return redirect('waiterHome')->with('successMsg','Successfully created');
            }
            return back()->with('errorMsg','not created');
        }
}
