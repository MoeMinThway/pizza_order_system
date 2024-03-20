<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //Order List
    public function orderList(){
        $orders = Order::select("orders.*","users.name as user_name",)
                    ->when(request('key'),function($query){
                            $query->where('users.name','like','%'.request('key').'%');
                      })
                    ->leftJoin('users','users.id','orders.user_id')
                    ->OrderBy('created_at','desc')
                    ->paginate(5);
        return view('admin.order.list',compact('orders'));
    }
    public function ajaxStatus(Request $request){
        logger($request->all());
        // $request->status =  $request->status !=null ? "": $request->status;

             $orders = Order::select("orders.*","users.name as user_name",)
                    ->when(request('key'),function($query){
                            $query->where('users.name','like','%'.request('key').'%');
                      })
                    ->leftJoin('users','users.id','orders.user_id')
                    ->OrderBy('created_at','desc');
            if($request->status == null){
                $orders = $orders->get();
            }else{
                    $orders = $orders->where('orders.status',$request->status)
                             ->get();
            }


         return response()->json($orders, 200);


    }
    // ajaxChangeStatus
    public function ajaxChangeStatus(Request $request){
        // logger($request->all());
        Order::where('id',$request->orderId)->update([
            'status'=> $request->status
        ]);
    }
}
