<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\Models\Orders;
use App\Models\Bills;
class BillController extends Controller
{
    //
    
    public function create($id){
        $orders = Orders::find($id);
        $createdBill = Bills::create([
            'userId'=>$orders->userId,
            'orderId'=>$id,
            'status'=>'pending',
        ]);
          $data = Bills::find($createdBill->id);
       $pdf = PDF::loadView('bills.Success', compact('data'));
       return $pdf->stream('invoice.pdf',array('Attachment'=>0));

    }
}
