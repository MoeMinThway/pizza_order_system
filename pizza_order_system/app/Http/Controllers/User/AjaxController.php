<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
