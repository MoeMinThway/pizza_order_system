<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    //pizzaList
    public function pizzaList(Request $request){
        // logger($request->all());
        if($request->status == 'desc'){
                    $data = Product::orderBy('created_at','desc')->get();
        }else {
              $data = Product::orderBy('created_at','asc')->get();

        }
        // return $data ;
                return  response()->json($data, 200);

    }
    // return pizza list
    public function addToCart(Request $request){
        // logger($request->all());
        $data = $this->getOrderData($request);
                // logger($data);
        Cart::create($data);

        $response = [
            'status' =>'success',
            'message' =>'Add to Cart is complete',
        ];
        return  response()->json($response, 200);


    }
    // order
    public function order(Request $request){
        // logger($request->all());

        $total = 3000;
        foreach($request->all( ) as $item){
            // OrderList::create($item);
           $data =  OrderList::create([
                "user_id"=>$item['user_id'],
                "product_id"=>$item['product_id'],
                "qty"=>$item['qty'],
                "total"=>$item['total'],
                "order_code"=>$item['order_code'],
            ]);
            $total += $data->total ;
        }




        Cart::where('user_id',Auth::user()->id)->delete();
        Order::create([
            'user_id' => Auth::user()->id,
            'order_code' =>$data->order_code,
            'total_price' =>$total,
        ]);

    $response = [
                    'status' =>'true',

            'message' =>'Order is complete',
        ];
        return  response()->json($response, 200);


    }
    // getOrderData
    private function getOrderData($request){
        return [
            'user_id'=> $request->userId,
            'product_id'=> $request->pizzaId,
            'qty'=> $request->count,
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now(),
        ];
    }

}
