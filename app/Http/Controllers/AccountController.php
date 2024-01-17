<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{
    //go to change Password Page
    public function changePasswordPage(){
       return view('admin.account.changePassword');
    }

    //change password
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

   //go to Account

   public function details(){
    return view('admin.account.detail');
   }
   //private functions

   //validate change password fields

   public function validatePassword($req){
    Validator::make($req->all(),[
        'oldPassword' => 'required|min:8',
        'newPassword' => 'required|min:8',
        'comfirmPassword' => 'required|min:8|same:newPassword'
    ])->validate();
   }
}
