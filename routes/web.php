<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\User\UserController;

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
   Route::get('home',[UserController::class,'home'])->name('user#Home');

   Route::prefix('password')->group(function (){
    Route::get('change',[UserController::class,'changePasswordPage'])->name('user#changePasswordPage');
    Route::post('change',[UserController::class,'changePassword'])->name('user#changePassword');

   });
   Route::prefix('account')->group(function(){
    Route::get('edit',[UserController::class,'editPage'])->name('user#accountEditPage');
    Route::post('edit',[UserController::class,'edit'])->name('user#accountEdit');



   });


   });
 //admin
 Route::prefix('admin')->middleware('admin_auth')->group(function(){

    //Admin List
    Route::get('list',[AdminController::class,'adminListPage'])->name('admin#adminListPage');
    Route::get('delete/{id}',[AdminController::class,'adminDelete'])->name('admin#adminDeletePage');
    Route::get('changerole/{id}',[AdminController::class,'changeRolePage'])->name('admin#changeRolePage');
    Route::post('changerole/{id}',[AdminController::class,'changeRole'])->name('admin#changeRole');

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
            Route::get('edit',[AccountController::class,'editAccount'])->name('admin#accountEditPage');
            Route::post('edit/{id}',[AccountController::class,'edit'])->name('admin#accountEdit');
        });

        //products
        Route::prefix('product')->group(function(){
             Route::get('list',[ProductsController::class,'listPage'])->name('admin#productList');
             Route::get( 'create', [ProductsController::class,'createPage'])->name('admin#productCreatePage');
             Route::post('create',[ProductsController::class,'create'])->name('admin#createProduct');
             Route::get('delete/{id}',[ProductsController::class,'delete'])->name('admin#deleteProduct');
             Route::get('details/{id}',[ProductsController::class,'details'])->name('admin#productDetails');
             Route::get('edit/{id}',[ProductsController::class,'editPage'])->name('admin#productEditPage');
             Route::post('edit/{id}',[ProductsController::class,'edit'])->name('admin#productEdit');


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
