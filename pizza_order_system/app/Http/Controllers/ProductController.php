<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    // 21
    //product list page
    public function list(){
        // dd(request('key'));
        $pizzas = Product::select("products.*",'categories.name as category_name')
        ->when(request('key'),function($query){
            $query->where('products.name','like','%'.request('key').'%');
        })
                ->leftJoin("categories",'products.category_id','categories.id')
                ->orderBy('products.created_at','desc')
                ->paginate(5);

        $pizzas->appends(request()->all());
        // dd($pizzas->toArray());
        return view('admin.product.pizzaList',compact('pizzas'));

    }
    public function createPage(){
        $categories =Category::select('id','name')->get();
        // dd  ($category->toArray());
        return view('admin.product.pizzaCreate',compact('categories'));
    }
    public function create(Request $request){
        // dd($request->toArray());
        $this->validatiorCheck($request,"create") ;
       $data=  $this->createProductData($request);


        // dd($request->pizzaImage);
        $fileName = uniqid().$request->file('pizzaImage')->getClientOriginalName();
        $request->file('pizzaImage')->storeAs('public',$fileName);
        $data['image'] =$fileName;



       Product::create($data);
       return redirect()->route('product#list');
    }
    public function delete($id){
        Product::where('id',$id)->delete();
        return redirect()->route('product#list')->with(['deleteSuccess'=>'Pizza Delete Success']);
    }


    public function edit($id){

       $pizza  = Product::where('id',$id)->first();
    //    dd($pizza->toArray());
        return view('admin.product.pizzaEdit',compact('pizza'));
    }

    public function updatePage($id){
        $pizza = Product::where('id',$id)->first();
        $categories = Category::get();
        // dd($category->toArray());
        // dd($pizza->toArray());
        return view('admin.product.pizzaUpdate',compact('pizza','categories'));
    }

    public function update(Request $request){
        // dd($request->toArray());
        $this->validatiorCheck($request,'update');
        $data =$this->createProductData($request);

        if($request->hasFile('pizzaImage')){
            $oldImageName= Product::where('id',$request->pizzaId)->first();
            $oldImageName = $oldImageName->image;

            if($oldImageName !=null){
                Storage::delete('public'.$oldImageName);
            }

            $fileName =uniqid().$request->file('pizzaImage')->getClientOriginalName();
            $request->file('pizzaImage')->storeAs('public/'.$fileName);
            $data['image']=$fileName;

        }

        Product::where('id',$request->pizzaId)->update($data);
        return redirect()->route('product#list');
    }

    private function createProductData($request){
        return [
            'name'=> $request->pizzaName,
            'category_id'=> $request->pizzaCategory,
            'description'=> $request->pizzaDescription,
            'price'=> $request->pizzaPrice,
            'waiting_time'=> $request->pizzaWaitingTime,

        ];
    }
    private function validatiorCheck($request,$action){
        $validationRule=[
            'pizzaName'=>'required |min:5|unique:products,name,'.$request->pizzaId,
            'pizzaCategory'=>'required',
            'pizzaDescription'=>'required|min:10',
            'pizzaPrice'=>'required',

            'pizzaWaitingTime'=>'required',

        ];
        $validationRule['pizzaImage']=$action == "create" ?  "required|mimes:jpg,svg,jpeg,webp,png": "" ;
        Validator::make($request->all(),$validationRule)->validate();
    }
}
