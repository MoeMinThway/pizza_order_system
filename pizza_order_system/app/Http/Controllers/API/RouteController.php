<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use App\Models\OrderList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RouteController extends Controller
{
    //productList
    public function productList(){
        $products = Product::get();
        // $users = User::get();


        $data =[
            'products'=>$products,
            // 'users'=>$users,
        ];
        return response()->json($data, 200);
    }
    //userList
    public function userList(){
        $users = User::get();
        $data =[
            'users'=>$users,
        ];
        return response()->json($data, 200);
    }
    //categoryList
    public function categoryList(){
        $categorys = Category::get();
        $data =[
            'categorys'=>$categorys,
        ];
        return response()->json($data, 200);
    }
    //cartList
    public function cartList(){
        $carts = Cart::get();
        $data =[
            'carts'=>$carts,
        ];
        return response()->json($data, 200);
    }
    //contactList
    public function contactList(){
        $contacts = Contact::get();
        $data =[
            'contacts'=>$contacts,
        ];
        return response()->json($data, 200);
    }
    //order
    public function order(){
        $orders = Order::get();
        $data =[
            'orders'=>$orders,
        ];
        return response()->json($data, 200);
    }
    //orderList
    public function orderList(){
        $orderLists = OrderList::get();
        $data =[
            'orderLists'=>$orderLists,
        ];
        return response()->json($data, 200);
    }
    public function createCategory(Request $request){
        // dd($request->all());
        // dd($request->header('headerData'));
        $data =$this->getCategoryData($request);
        $response =  Category::create($data);
        return response()->json($response, 200);

    }
    public function createProduct(Request $request){
        // dd($request->all());
        // dd($request->header('headerData'));
        $data = [
            'category_id'=>$request->category_id,
            'name'=>$request->name,
            'description'=>$request->description,
            'image'=>$request->image,
            'price'=>$request->price,
            'waiting_time'=>$request->waiting_time,
            'view_count'=>$request->view_count,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        $response =  Product::create($data);
        return response()->json($response, 200);

    }
    public function createUser(Request $request){
        // dd($request->all());
        // dd($request->header('headerData'));
        $data = [
            'name'=>$request->name,
            'email'=>$request->email,
            'image'=>$request->image,
            'phone'=>$request->phone,
            'address'=>$request->address,
            'gender'=>$request->gender,
            'role'=>$request->role,
            'password'=>$request->password,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        $response =  User::create($data);
        return response()->json($response, 200);

    }
    public function createCart(Request $request){
        // dd($request->all());
        // dd($request->header('headerData'));
        $data = [
            'user_id'=>$request->user_id,
            'product_id'=>$request->product_id,
            'qty'=>$request->qty,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        $response =  Cart::create($data);
        return response()->json($response, 200);

    }
    public function createContact(Request $request){
        // dd($request->all());
        // dd($request->header('headerData'));
        $data = [
            'name'=>$request->name,
            'email'=>$request->email,
            'message'=>$request->message,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        $response =  Contact::create($data);
        return response()->json($response, 200);

    }
    public function createOrder(Request $request){
        // dd($request->all());
        // dd($request->header('headerData'));
        $data = [
            'user_id'=>$request->user_id,
            'order_code'=>$request->order_code,
            'total_price'=>$request->total_price,
            'status'=>$request->status,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        $response =  Order::create($data);
        return response()->json($response, 200);

    }
    public function createOrderList(Request $request){
        // dd($request->all());
        // dd($request->header('headerData'));
        $data = [
            'user_id'=>$request->user_id,
            'product_id'=>$request->product_id,
            'qty'=>$request->qty,
            'total'=>$request->total,
            'order_code'=>$request->order_code,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        $response =  OrderList::create($data);
        return response()->json($response, 200);

    }
    public function deleteCategoryByPost(Request $request){
        $data = Category::where('id',$request->id)->first();

        if(isset($data)){
            Category::where ('id',$request->id)->delete();
            return response()->json( [  'message'=> "delete success" ], 200);
        }
        return response()->json( ['message'=> "There is no data with your id" ], 200);
    }
    public function deleteCategoryByGet($id){
        $data = Category::where('id',$id)->first();

        if(isset($data)){
            Category::where ('id',$id)->delete();
            return response()->json( [  'message'=> "delete success" ], 200);
        }
        return response()->json( ['message'=> "There is no data with your id" ], 200);
    }

    public function categoryDetails(Request $request){
           $data = Category::where('id',$request->id)->first();

        if(isset($data)){

            return response()->json( [  'message'=> " success" ,'category Details'=> $data], 200);
        }
        return response()->json( ['message'=> "There is no data with your id" ], 200);

    }
    public function categoryListByGet($id){
           $data = Category::where('id',$id)->first();

        if(isset($data)){

            return response()->json( [  'message'=> " success" ,'category Details'=> $data], 200);
        }
        return response()->json( ['message'=> "There is no data with your id" ], 200);

    }
    // categoryUpdate
    public function categoryUpdate(Request $request ){
        $data = $this->getCategoryData($request);
             $category = Category::where('id',$request->id)->first();

        if(isset($category)){
           $c =   Category::where('id',$request->id)->update($data);
                   return response()->json( [  'message'=> " success" ], 200);

        }
         return response()->json( [  'message'=> " fail" ], 200);


    }
    private function getCategoryData ($request){
        return [
            'name'=>$request->name,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
