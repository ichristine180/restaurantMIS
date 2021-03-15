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

class SuperVisorController extends Controller
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
                    return '<a href="/bill/'.$orders->id.'" class="btn btn-danger btn-sm" id="getEditArticleData"  target="_blank" >Cancel</a>';
                    }
                })
                ->rawColumns(['Actions'])
                ->toJson();
        }
        return view('superVisorDashboard.blade');
    }
}
