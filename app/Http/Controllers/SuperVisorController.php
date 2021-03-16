<?php

namespace App\Http\Controllers;
use DB;
use PDF;
use App\Models\User;
use App\Models\Tables;
use App\Models\Orders;
use App\Models\CancelOrder;
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
                    return '<a href="/cancelOrder/'.$orders->id.'" class="btn btn-danger btn-sm" id="getEditArticleData" >Cancel</a>';
                    }
                })
                ->rawColumns(['Actions'])
                ->toJson();
        }
        return view('superVisorDashboard.blade');
    }
    public function cancelOrder($id){
        $order = Orders::find($id);
        $user = new User();
        $role = $user->userRole(Auth::User()->role);
        $isWaiter = $user->hasWaiter(Auth::User()->role);
        return view('orders.cancel',compact('order','role','isWaiter'));
        }
        
        
        public function postCancel($id,Request $request){
         $order = Orders::find($id);
         $userId = Auth::user()->id;
         $reason = $request['reason'];
         $order->status ="canceled";
         $order->save();
         $canceled = CancelOrder::create([
         "userId"=>$userId,
         "orderId"=>$order->id,
         "reason"=>$reason
         ]);
         return redirect('supervisorHome');
        }
        public function canceled(){
        $user = new User();
        $role = $user->userRole(Auth::User()->role);
        $isWaiter = $user->hasWaiter(Auth::User()->role);
        return view('orders.canceled',compact('role','isWaiter'));
        }
        public function canceledList(Request $request){
        
            if ($request->ajax()) {
                $model = CancelOrder::with(['bill','user'])
              ;
                    return DataTables::eloquent($model)
                    
                    ->addIndexColumn()
                    ->editColumn('created_at', function ($model) 
                    {
        //change over here
                   return date('m-d H', strtotime($model->created_at) );
                      })
                    ->addColumn('name',function (CancelOrder $model) {
                        return $model->user->name;
                    })
                    ->addColumn('ammount',function (CancelOrder $model) {
                        return $model->order->ammount;
                    })
                    ->addColumn('status',function (CancelOrder $model) {
                        return $model->order->status;
                    })
                    ->toJson();
                    return date('d-m-Y', strtotime($model->created_at) );
            }
            return view('orders.canceled');
        }
        public function printCanceled(){
            $data = CancelOrder::get();
            
              $pdf = PDF::loadView('bills.pdf.ordersCancled', compact('data'));
              $pdf->getDomPDF()->set_option("enable_php", true);
               return $pdf->stream('Canceledbills.pdf',array('Attachment'=>0));
        }
}
