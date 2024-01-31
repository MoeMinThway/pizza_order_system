<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    //product list page
    public function list(){
        $pizzas = Product::orderBy('created_at','desc')->paginate(5);
        // dd($pizzas->toArray());
        return view('admin.product.pizzaList',compact('pizzas'));

    }
    public function createPage(){
        $categories =Category::select('id','name')->get();
        // dd  ($category->toArray());
        return view('admin.product.create',compact('categories'));
    }
    public function create(Request $request){
        // dd($request->toArray());
        $this->validatiorCheck($request);
       $data=  $this->createProductData($request);


        // dd($request->pizzaImage);
        $fileName = uniqid().$request->file('pizzaImage')->getClientOriginalName();
        $request->file('pizzaImage')->storeAs('public',$fileName);
        $data['image'] =$fileName;



       Product::create($data);
       return redirect()->route('product#list');
    }

    private function createProductData($request){
        return [
            'name'=> $request->pizzaName,
            'category_id'=> $request->pizzaCategory,
            'description'=> $request->pizzaDescription,
            'price'=> $request->pizzaPrice,
            'waitng_time'=> $request->pizzaWaitingTime,

        ];
    }
    private function validatiorCheck($request){
        Validator::make($request->all(),[
            'pizzaName'=>'required |min:5|unique:products,name',
            'pizzaCategory'=>'required',
            'pizzaDescription'=>'required|min:10',
            'pizzaPrice'=>'required',
            'pizzaImage'=>"required",
            'pizzaWaitingTime'=>'required',

        ])->validate();
    }
}
