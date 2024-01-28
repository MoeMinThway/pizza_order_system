    <?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\CategoryController;



//login , register
Route::redirect('/','loginPage');
Route::get('loginPage',[AuthController::class,'loginPage'])->name("auth#loginPage");
Route::get('registerPage',[AuthController::class,'registerPage'])->name("auth#registerPage");

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified',])->group(function () {
    //dashboard
    Route::get('dashboard',[AuthController::class,'dashboard'])->name('dashboard');

    //admin
    //category
    Route::group(['prefix'=>'category','middleware'=>'admin_auth'],function () {
        Route::get('list',[CategoryController::class,'list'])->name('category#list');
    });
    //user
    //home
    Route::group(['prefix'=>'user','middleware'=>'user_auth'],function () {
         Route::get('home',[AuthController::class,'home'])->name('user#home');
    });


});









//
