<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RouteController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('apiTesting',function(){
    $data = [
        "message"=>"this is api testing"
    ];
    return  response()->json($data, 200);
});

//get
Route::get('product/list',[RouteController::class,'productList']);
Route::get('user/list',[RouteController::class,'userList']);
Route::get('category/list',[RouteController::class,'categoryList']);
Route::get('cart/list',[RouteController::class,'cartList']);
Route::get('contact/list',[RouteController::class,'contactList']);
Route::get('order/',[RouteController::class,'order']);
Route::get('order/list',[RouteController::class,'orderList']);


//post create
Route::post('create/product',[RouteController::class,'createProduct']);
Route::post('create/user',[RouteController::class,'createUser']);
Route::post('create/category',[RouteController::class,'createCategory']);
Route::post('create/cart',[RouteController::class,'createCart']);
Route::post('create/contact',[RouteController::class,'createContact']);
Route::post('create/order',[RouteController::class,'createOrder']);
Route::post('create/order/list',[RouteController::class,'createOrderList']);

//post delete
Route::post('delete/category',[RouteController::class,'deleteCategoryByPost']);

//get delete
Route::get('delete/category/{id}',[RouteController::class,'deleteCategoryByGet']);

//post detail
Route::post('category/detail',[RouteController::class,'categoryDetails']);


//get details
Route::get('category/list/{id}',[RouteController::class,'categoryListByGet']);


// post update
Route::post('category/update',[RouteController::class,'categoryUpdate']);


//
/**product list(get)
 * http://127.0.0.1:8000/api/product/list
 *
 *category list(get)
 * http://127.0.0.1:8000/api/category/list
 *
 *
 */
