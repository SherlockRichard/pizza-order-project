<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Category;
use App\Models\Products;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //
    public function home(){
        $products = Products::get();
        $categories = Category::get();
        return view('user.home',compact('products','categories'));
    }

    //go to change password page
    public function changePasswordPage(){
        return view('user.account.changepasswordpage');
    }

    // go to change password
    public function changePassword(Request $req){

    $this -> validatePassword($req);
    $currentUserID =Auth::user()->id;
     //SELECT password FORM users WHERE id = $currentUserID
     $userData = User::select('password')->where('id',$currentUserID)->first();
     $dbpassword = $userData->password;

     //check if old password is correct
     if(Hash::check($req->oldPassword,$dbpassword)){
       $data = [
        'password' => Hash::make($req->newPassword)
       ];
       User::where('id', Auth::user()->id)->update($data);

       //log out the current user
       Auth::logout();

       return redirect()->route('auth#login');
     }

     return back()->with(['noMatch'=>'Credentials do not match!']);


    }

    // go to account edit page
    public function editPage(){
        return view('user.account.editpage');
    }

    //go to edit
     public function edit(Request $req){

    $this->validateAccountDetails($req);
    $data = $this->getAccountDetails($req);

    if($req->hasfile('image')){

      $dbImage = User::where('id',Auth::user()->id)->first();
      $dbImage = $dbImage->image;

      //if image is already exist
      if($dbImage !== null){
        Storage::delete('public/'.$dbImage);
      }

        $fileName = uniqid().$req->file('image')->getClientOriginalName();
        $req->file('image')->storeAs('public',$fileName);
        $data['image'] =$fileName;
    }
    User::where('id',Auth::user()->id)->update($data);
    return back();

   }


     public function validatePassword($req){
    Validator::make($req->all(),[
        'oldPassword' => 'required|min:8',
        'newPassword' => 'required|min:8',
        'comfirmPassword' => 'required|min:8|same:newPassword'
    ])->validate();
   }

   // validate account edit
    public function validateAccountDetails($req){
    Validator::make($req->all(),[

        'name'  => 'required',
        'email' => 'required',
        'phone' => 'required',
       'address' => 'required',
       'updated_at' => Carbon::now('UTC')->setTimezone('Asia/Yangon'),

    ])->validate();

   }
   //  get account data(change array format)
   public function getAccountDetails($req){
    return [
        'name' => $req->name,
        'email'=> $req->email,
        'phone'=> $req->phone,
        'address' => $req->address,
    ];
   }
}
