    <?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;



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
    });
19
    //user
    //home
    Route::group(['prefix'=>'user','middleware'=>'user_auth'],function () {
         Route::get('home',function(){
            return view('user.home');
         })->name('user#home');
    });


});









//
