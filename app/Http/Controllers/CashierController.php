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

class CashierController extends Controller
{
    //
    public function nonPayed(Request $request){
        if ($request->ajax()) {
            $model = Orders::with(['item','tables','user'])->where('status','=','pending')
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
                ->addColumn('Actions', function($orders) {
                    if($orders->bill == null){
                    return '<a href="/bill/'.$orders->id.'" class="btn btn-success btn-sm" id="getEditArticleData"  target="_blank" >Create bills</a>';
                    }
                    return '
                    <a href="/pay/'.$orders->bill->id.'" class="btn btn-info btn-sm" id="getEditArticleData">Pay</a>';
                })
                ->rawColumns(['Actions'])
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
        return view('cashier.Paid');
    }
    public function paid()
    {
        $user = new User();
        $role = $user->userRole(Auth::User()->role);
        $isWaiter = $user->hasWaiter(Auth::User()->role);
        return view('cashier.Paid', compact('role','isWaiter'));
    }
    public function archived()
    {
        $user = new User();
        $role = $user->userRole(Auth::User()->role);
        $isWaiter = $user->hasWaiter(Auth::User()->role);
        return view('cashier.Archived', compact('role','isWaiter'));
       
    }
    public function archivedList(Request $request){
        if ($request->ajax()) {
            $model = Orders::with(['item','tables','user'])->where('status','=','archived');
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
        return view('cashier.Archived');
    }
    
 
}
