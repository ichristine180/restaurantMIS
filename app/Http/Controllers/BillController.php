<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\Models\Orders;
use App\Models\Bills;
use App\Models\cancelBill;
use Auth;
use DataTables;
use App\Models\User;
class BillController extends Controller
{
    //
    
    public function create($id){
        $orders = Orders::find($id);
        $createdBill = Bills::create([
            'userId'=>$orders->userId,
            'orderId'=>$id,
            'status'=>'pending',
            'billNumber'=>rand(100,10000)
        ]);
          $data = Bills::find($createdBill->id);
       $pdf = PDF::loadView('bills.Success', compact('data'));
       return $pdf->stream('invoice.pdf',array('Attachment'=>0));

    }
    public function pay($id){
        $bill = Bills::find($id);
        $bill->order->status = 'paid';
        $bill->order->save();
        $bill->status = 'paid';
        $bill->save();
       
   return redirect('cashierHome')->with('successMsg','Successfully paid');
        
    }
    public function bills(){
        $user = new User();
        $role = $user->userRole(Auth::User()->role);
        $isWaiter = $user->hasWaiter(Auth::User()->role);
       $payedBills = Bills::where('status','=','paid')
       ->count();
       $allBills = Bills::get()
       ->count();
       $nonPayedBills = Bills::where('status','=','pending')
       ->count();
       $archivedBills = Bills::where('status','=','archived')
       ->count();
       //dd($payedOrders);
        return view('bills.bills', compact('role','archivedBills','nonPayedBills',
        'allBills','payedBills','isWaiter'));
    }

    public function paidBills(Request $request){
        if ($request->ajax()) {
            $model = Bills::with(['order','user'])->where('status','=','paid')
          ;
                return DataTables::eloquent($model)
                
                ->addIndexColumn()
                ->editColumn('updated_at', function ($model) 
                {
    //change over here
               return date('m-d H', strtotime($model->created_at) );
                  })
                ->addColumn('name',function (Bills $model) {
                    return $model->user->name;
                })
                ->addColumn('ammount',function (Bills $model) {
                    return $model->order->ammount;
                })
               
                ->toJson();
                return date('d-m-Y', strtotime($model->created_at) );
        }
        return view('bills.bills');
    }
    public function nonPaid(){
        $user = new User();
        $role = $user->userRole(Auth::User()->role);
        $isWaiter = $user->hasWaiter(Auth::User()->role);
       
       //dd($payedOrders);
        return view('bills.NonPaid', compact('role',
        'isWaiter'));
    }

    public function notpaidBills(Request $request){
        if ($request->ajax()) {
            $model = Bills::with(['order','user'])->where('status','=','pending')
          ;
                return DataTables::eloquent($model)
                
                ->addIndexColumn()
                ->editColumn('created_at', function ($model) 
                {
    //change over here
               return date('m-d H', strtotime($model->created_at) );
                  })
                ->addColumn('name',function (Bills $model) {
                    return $model->user->name;
                })
                ->addColumn('ammount',function (Bills $model) {
                    return $model->order->ammount;
                })
                ->addColumn('Actions', function($orders) {
                    if($orders->satatus = 'pending'){
                    return '<a href="/cancel/'.$orders->id.'" class="btn btn-danger btn-sm" id="getEditArticleData">Cancel</a>';
                    }
                })
                ->rawColumns(['Actions'])
                ->toJson();
                return date('d-m-Y', strtotime($model->created_at) );
        }
        return view('bills.NonPaid');
    }

    public function archived(){
        $user = new User();
        $role = $user->userRole(Auth::User()->role);
        $isWaiter = $user->hasWaiter(Auth::User()->role);
       
       //dd($payedOrders);
        return view('bills.archived', compact('role',
        'isWaiter'));
    }
    public function billsList(){
        $user = new User();
        $role = $user->userRole(Auth::User()->role);
        $isWaiter = $user->hasWaiter(Auth::User()->role);
       
       //dd($payedOrders);
        return view('bills.billsList', compact('role',
        'isWaiter'));
    }
    
    public function all(Request $request){
        if ($request->ajax()) {
            $model = Bills::with(['order','user'])
          ;
                return DataTables::eloquent($model)
                
                ->addIndexColumn()
                ->editColumn('created_at', function ($model) 
                {
    //change over here
               return date('m-d H', strtotime($model->created_at) );
                  })
                ->addColumn('name',function (Bills $model) {
                    return $model->user->name;
                })
                ->addColumn('ammount',function (Bills $model) {
                    return $model->order->ammount;
                })
               
                ->toJson();
                return date('d-m-Y', strtotime($model->created_at) );
        }
        return view('bills.all');
    }
    

    public function archivedList(Request $request){
        if ($request->ajax()) {
            $model = Bills::with(['order','user'])->where('status','=','archived')
          ;
                return DataTables::eloquent($model)
                
                ->addIndexColumn()
                ->editColumn('created_at', function ($model) 
                {
    //change over here
               return date('m-d H', strtotime($model->created_at) );
                  })
                ->addColumn('name',function (Bills $model) {
                    return $model->user->name;
                })
                ->addColumn('ammount',function (Bills $model) {
                    return $model->order->ammount;
                })
               
                ->toJson();
                return date('d-m-Y', strtotime($model->created_at) );
        }
        return view('bills.archived');
    }
public function printAll(){
    $data = Bills::get();
    
      $pdf = PDF::loadView('bills.pdf.billsList', compact('data'));
      $pdf->getDomPDF()->set_option("enable_php", true);
       return $pdf->stream('bills.pdf',array('Attachment'=>0));
}
public function printAllOrders(){
    $data = Orders::get();
    $pdf = PDF::loadView('orders.pdf.all', compact('data'));
    $pdf->getDomPDF()->set_option("enable_php", true);
     return $pdf->stream('orders.pdf',array('Attachment'=>0));
}
public function cancel($id){
$bill = Bills::find($id);
$user = new User();
$role = $user->userRole(Auth::User()->role);
$isWaiter = $user->hasWaiter(Auth::User()->role);
return view('bills.cancel',compact('bill','role','isWaiter'));
}


public function postCancel($id,Request $request){
 $bill = Bills::find($id);
 $userId = Auth::user()->id;
 $reason = $request['reason'];
 $bill->status ="canceled";
 $bill->save();
 $canceled = cancelBill::create([
 "userId"=>$userId,
 "billId"=>$bill->id,
 "reason"=>$reason
 ]);
 if($canceled->id != null)
 return redirect('bills');
 else 
 return redirect('cancel',$id);
}
public function canceled(){
$user = new User();
$role = $user->userRole(Auth::User()->role);
$isWaiter = $user->hasWaiter(Auth::User()->role);
return view('bills.canceled',compact('role','isWaiter'));
}
public function canceledList(Request $request){

    if ($request->ajax()) {
        $model = cancelBill::with(['bill','user'])
      ;
            return DataTables::eloquent($model)
            
            ->addIndexColumn()
            ->editColumn('created_at', function ($model) 
            {
//change over here
           return date('m-d H', strtotime($model->created_at) );
              })
            ->addColumn('name',function (cancelBill $model) {
                return $model->user->name;
            })
            ->addColumn('ammount',function (cancelBill $model) {
                return $model->bill->order->ammount;
            })
            ->addColumn('billNumber',function (cancelBill $model) {
                return $model->bill->billNumber;
            })
            ->addColumn('status',function (cancelBill $model) {
                return $model->bill->status;
            })
            ->toJson();
            return date('d-m-Y', strtotime($model->created_at) );
    }
    return view('bills.canceled');
}
public function printCanceled(){
    $data = cancelBill::get();
    
      $pdf = PDF::loadView('bills.pdf.canceled', compact('data'));
      $pdf->getDomPDF()->set_option("enable_php", true);
       return $pdf->stream('Canceledbills.pdf',array('Attachment'=>0));
}
}
