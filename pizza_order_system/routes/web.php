    <?php

use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\User\AjaxController;
use App\Http\Controllers\User\UserController;




//login , register

Route::group(['middleware'=>'admin_auth',"user_auth"],function(){
    Route::redirect('/','loginPage');
    Route::get('loginPage',[AuthController::class,'loginPage'])->name("auth#loginPage");
    Route::get('registerPage',[AuthController::class,'registerPage'])->name("auth#registerPage");
});


Route::middleware(['auth'])->group(function () {
    //dashboard
    Route::get('dashboard',[AuthController::class,'dashboard'])->name('dashboard');

    //admin
    // Route::group(['middleware'=>'admin_auth'],function(){
    // });

    Route::middleware(['admin_auth'])->group(function(){
        //category
        Route::group(['prefix'=>'category'],function () {
            Route::get('list',[CategoryController::class,'list'])->name('category#list');
            Route::get('create/page',[CategoryController::class,'createPage'])->name('category#categoryPage');
            Route::post('create',[CategoryController::class,'create'])->name('category#create');
            Route::get('delete/{id}',[CategoryController::class,'delete'])->name('category#delete');
            Route::get('edit/{id}',[CategoryController::class,'edit'])->name('category#edit');
            Route::post('update',[CategoryController::class,'update'])->name('category#update');
         });

         //admin account
         Route::prefix('admin')->group(function(){
            //password
            Route::get('password/changePage',[AdminController::class,'changePasswordPage'])->name('admin#changPasswordPage');
            Route::post('change/password',[AdminController::class,'changePassword'])->name('admin#changPassword');

            //profile
            Route::get('details',[AdminController::class,'details'])->name('admin#details');
            Route::get('edit',[AdminController::class,'edit'])->name('admin#edit');
            Route::post('update/{id}',[AdminController::class,'update'])->name('admin#update');

            //admin list
            Route::get('list',[AdminController::class,'list'])->name('admin#list');
            Route::get('delete/{id}',[AdminController::class,'delete'])->name('admin#delete');
            Route::get('changeRole/{id}',[AdminController::class,'changeRole'])->name('admin#changeRole');
            Route::post('change/role/{id}',[AdminController::class,'change'])->name('admin#change');
            Route::get('change/role/ajax',[AdminController::class,'changeRoleAjax'])->name('admin#changeRoleAjax');

         });
         Route::group(['prefix'=> "products"],function(){
            Route::get('list',[ProductController::class,"list"])->name('product#list');
            Route::get('create',[ProductController::class,"createPage"])->name('product#createPage');
            Route::post('create',[ProductController::class,"create"])->name('product#create');
            Route::get('delete/{id}',[ProductController::class,"delete"])->name('product#delete');
            Route::get('edit/{id}',[ProductController::class,"edit"])->name('product#edit');
            Route::get('updatePage/{id}',[ProductController::class,"updatePage"])->name('product#updatePage');
            Route::post('update',[ProductController::class,"update"])->name('product#update');
         });
         Route::group(['prefix'=> "order"],function(){
            Route::get('list',[OrderController::class,"orderList"])->name('admin#orderList');
            Route::get('change/status',[OrderController::class,"changeStatus"])->name('admin#changeStatus');
            Route::get('ajax/change/status',[OrderController::class,"ajaxChangeStatus"])->name('admin#ajaxChangeStatus');
            Route::get('listInfo/{id}',[OrderController::class,"listInfo"])->name('admin#listInfo');
         });
         Route::group(['prefix'=> "user"],function(){
            Route::get('list',[UserController::class,"userList"])->name('admin#userList');
            Route::get('change/role',[UserController::class,"changeRoleIn"])->name('admin#changeRoleIn');
            Route::get('delete/{id}',[UserController::class,"userDelete"])->name('admin#userDelete');
            Route::get('edit/{id}',[UserController::class,"userEdit"])->name('admin#userEdit');
            Route::post('update/{id}',[UserController::class,"userUpdate"])->name('admin#userUpdate');

         });
        Route::group(['prefix'=> "contact"],function(){
            Route::get('list',[AdminController::class,"contactList"])->name('admin#contactList');

         });

    });

    //user
    //home
    Route::group(['prefix'=>'user','middleware'=>'user_auth'],function () {
        //  Route::get('home',function(){
        //     return view('user.home');
        //  })->name('user#home');

        //  home
        Route::get('/homePage',[UserController::class,'home'])->name('user#home');
        Route::get('/filter/{id}',[UserController::class,'filter'])->name('user#filter');
        Route::get('/history',[UserController::class,'history'])->name('user#history');

        Route::prefix('pizza')->group(function(){
            Route::get('details/{id}',[UserController::class,'pizzaDetails'])->name('user#pizzaDetails');
        });


        Route::prefix('cart')->group(function(){
            Route::get('list',[UserController::class,'cartList'])->name('user#cartList');
        });


        //password
        Route::prefix('password')->group(function(){
            Route::get('change',[UserController::class,'changePasswordPage'])->name('user#changePasswordPage');
            Route::post('change',[UserController::class,'changePassword'])->name('user#changePassword');
        });

        //account
        Route::prefix('account')->group(function(){
            Route::get('change',[UserController::class,'accountChangePage'])->name('user#accountChangePage');
            Route::post('change/{id}',[UserController::class,'accountChange'])->name('user#accountChange');
        });

        Route::prefix('ajax')->group(function(){
            Route::get('pizza/list',[AjaxController::class,'pizzaList'])->name('ajax#pizzaList');
            Route::get('addToCart',[AjaxController::class,'addToCart'])->name('ajax#addToCart');
            Route::get('order',[AjaxController::class,'order'])->name('ajax#order');
            Route::get('clear/cart',[AjaxController::class,'clearCart'])->name('ajax#clearCart');
            Route::get('clear/product',[AjaxController::class,'clearProduct'])->name('ajax#clearProduct');
            Route::get('increase/viewCount',[AjaxController::class,'viewCount'])->name('ajax#viewCount');

        });
        Route::prefix('contact')->group(function(){
            Route::get('contact',[UserController::class,'contact'])->name('user#contact');
            Route::get('contact/send/data',[UserController::class,'sendData'])->name('user#sendData');
        });
    });


});




Route::get('webTesting',function(){
    $data = [
        "message"=>"this is web testing"
    ];
    return  response()->json($data, 200);
});





//
