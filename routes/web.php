<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\CategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::middleware(['auth'])->group(function () {

    //dashboard
    Route::get('dashboard',[AuthController::class,'dashboard'])->name('auth#dashboard');


   //user

   Route::prefix('user')->middleware('user_auth')->group(function(){
    Route::get('list',function(){
     return view('user.list');
       })->name('user#list');
   });

 //admin
 Route::prefix('admin')->middleware('admin_auth')->group(function(){
    //category
    Route::prefix('category')->group(function(){
         Route::get('list',[CategoryController::class,'listPage'])->name('admin#categorylist');
         Route::get('create',[CategoryController::class,'createPage'])->name('admin#categoryCreatePage');
         Route::post('create',[CategoryController::class,'create'])->name('admin#createCategory');
         Route::get('delete/{id}',[CategoryController::class,'delete'])->name('admin#deleteCategory');
         Route::get('edit/{id}',[CategoryController::class,'editPage'])->name('admin#categoryEditPage');
         Route::post('edit/{id}',[CategoryController::class,'edit'])->name('admin#editCategory');

        });

        //account
        Route::prefix('account')->group(function(){
            Route::get('password/change',[AccountController::class,'changePasswordPage'])->name('admin#changePasswordPage');
            Route::post('password/change',[AccountController::class,'changePassword'])->name('admin#changePassword');
            Route::get('detail',[AccountController::class,'details'])->name('admin#accountDeatils');
        });
    });


});


// authentication(login,register)
Route::redirect('/', 'loginPage');
Route::get('loginPage',[AuthController::class,'loginPage'])->name('auth#login');
Route::get('registerPage',[AuthController::class,'registerPage'])->name('auth#register');
// admin

// user
// Route::get('/list',function(){
//     return view('user.list');
// })->name('user#list');
