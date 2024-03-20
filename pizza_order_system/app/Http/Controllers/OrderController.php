<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderList;
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
    public function changeStatus(Request $request){
        // dd($request->all());
        // logger($request->all());
        // $request->status =  $request->status !=null ? "": $request->status;

             $orders = Order::select("orders.*","users.name as user_name",)
                    ->when(request('key'),function($query){
                            $query->where('users.name','like','%'.request('key').'%');
                      })
                    ->leftJoin('users','users.id','orders.user_id')
                    ->OrderBy('created_at','desc');
            if($request->orderStatus == null){
                $orders = $orders->paginate(5);
            }else{
                $orders = $orders->where('orders.status',$request->orderStatus)
                             ->paginate(5);
            }


        //  return response()->json($orders, 200);
            return view('admin.order.list',compact('orders'));



    }
    // ajaxChangeStatus
    public function ajaxChangeStatus(Request $request){
        // logger($request->all());
        Order::where('id',$request->orderId)->update([
            'status'=> $request->status
        ]);
    }

    //listInfo
    public  function listInfo($orderCode){
     $orderList = OrderList::
                        select('order_lists.*','users.name as user_name','products.name as product_name','products.image as product_image','products.price as product_price')
                        ->leftJoin('users','users.id','order_lists.user_id')
                        ->leftJoin('products','products.id','order_lists.product_id')
                        ->where('order_code',$orderCode)
                        ->get();

// dd($orderList->toArray());
    $orderStatus = Order::select('status','total_price')->where('order_code',$orderCode)->get();

// dd($orderStatus->toArray());
       return view('admin.order.productList',compact('orderList','orderStatus'));

    }
}
