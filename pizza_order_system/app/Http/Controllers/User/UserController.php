<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //user home page
    public function home(){
        $pizzas = Product::orderBy('created_at','desc')->get();
        $category = Category::get();
        $cart = Cart::where('user_id',Auth::user()->id)-> get();
        $history = Order::where('user_id',Auth::user()->id)->get();
        return view('user.main.home',compact('pizzas','category','cart','history'));
    }
    //changePasswordPage
    public function changePasswordPage(){
        return view('user.password.change');
    }
    public function changePassword(Request $request){
        /*
            1 all field must be fill
            2  new password and comfim pw must be greater than 6
            3 new password and comfim pw must be same
            4 client old pw must be same with db password
            5 password change

        */

        $this->passwordValidationCheck($request);

        $currentId= Auth::user()->id;

        $user =User::select('password')->where("id",$currentId)->first();
        $dbHashValue = $user->password;

        if(Hash::check($request->oldPassword ,$dbHashValue)){
            $data = [
                'password'=>Hash::make($request->newPassword)
           ] ;
            User::where('id',Auth::user()->id)->update($data);
            // Auth::logout();
            // return redirect()->route('auth#loginPage');

            return redirect()->route('user#home')->with(['pwChangeSuccess'=>"Password Change Success. "]);
        }
        return back()->with(['notMatch'=>"The old Password not match try again. "]);

    }


        //accountChangePage
        public function accountChangePage(){
            return view('user.profile.account');
        }

        //user  account Change
        public function accountChange($id,Request $request){
            $this->accountValidationCheck($request);
             $data = $this->getUserData($request);

             //image
             if($request->hasFile('image')){
                 //1 old image name | 2. check =>if exist ,  delete | 3. store
                 $dbUser= User::where('id',$id)->first();
                 $dbImage= $dbUser->image;

                 //to keep the name for store(get the file name)
                 $fileName= uniqid().$request->file('image')->getClientOriginalName();
                 // actually store in frontend
                 $request->file('image')->storeAs('public',$fileName);
                 //db store
                 $data['image'] = $fileName;

                 if($dbImage != null){
                     Storage::delete('public/'.$dbImage);
                 }



             }

           User::where('id',$id)->update($data);

             return back()->with(['updateSuccess'=>"User Account Update Success"]);
         }

         // filter
         public function filter($CategoryId){
            // dd($CategoryId);
            $pizzas = Product::where('category_id',$CategoryId)->orderBy('created_at','desc')->get();
            $category = Category::get();
            $cart = Cart::where('user_id',Auth::user()->id)-> get();
            $history = Order::where('user_id',Auth::user()->id)->get();


            //    dd($pizzas->toArray());

             return view('user.main.home',compact('pizzas','category','cart','history'));
         }

        //  pizzaDetails
        public  function pizzaDetails($pizzaId){
            // dd($pizzaId);
             $pizza = Product::where('id',$pizzaId)->first();
             $pizzaList = Product::get();
            //  dd($pizza->image);

            return view('user.main.details',compact('pizza','pizzaList'));
        }
        //cartList
        public function cartList(){
            $cartList = cart::select('carts.*','products.name as pizza_name','products.price as pizza_price','products.image as product_image')
                ->leftJoin('products','products.id','carts.product_id')
                ->where("carts.user_id",Auth::user()->id)
                ->get();

            $totalPrice = 0;
            foreach($cartList as $c){
                $totalPrice += ($c->pizza_price*$c->qty);
            }
            // dd($totalPrice);
            return view('user.main.cart',compact('cartList','totalPrice'));
        }

        // history
        public function history(){
            $order = Order::where('user_id',Auth::user()->id)->orderBy('created_at','desc')->paginate(7);
            // dd($order->toArray());
            return view('user.main.history',compact("order"));
        }
// ===============================================
        // userList in Admin
        public function userList(){
            $users = User::where('role','user')->paginate(3);
            // dd($users->toArray()); //all user
            return view('admin.user.list',compact('users'));
        }
        public function changeRoleIn(Request $request){
            // logger($request->all());
            User::where('id',$request->userId)->update(
           [
             'role'=>$request->role
           ]
            );

        }
        // contact
        // public function 


      //password Validation Check
      private function passwordValidationCheck($request){
        Validator::make($request->all(),[
            'oldPassword'=>"required|min:6",
            'newPassword'=>"required|min:6",
            'confirmPassword'=>"required|min:6|same:newPassword"
        ])->validate();
    }
    private function accountValidationCheck($request){
        Validator::make($request->all(),[
            'name'=>"required|min:3",
            'phone'=>"required|min:3",
            'email'=>"required|min:3",
            'address'=>"required|min:3",
            'image'=>"mimes:png,jpeg,jpg,svg,webp|file",

        ])->validate();
    }
    private function getUserData($request){
        return [
            'name'=>$request->name,
            'phone'=>$request->phone,
            'email'=>$request->email,
            'address'=>$request->address,
            'gender'=>$request->gender,
            'created_at'=>Carbon::now()
        ];
    }
}
