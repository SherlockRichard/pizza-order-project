<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //

    // go to loginPage
    public function loginPage(){
        return view('login');
    }

    // go to registerPage
    public function registerPage(){
        return view('register');
    }

    //go to dashboard
    public function dashboard()  {
        if(Auth::user()->role =='admin'){
        //redirect to admin dashboard
        //  return view('admin.category.list');
        return redirect()->route('admin#categorylist');

    }
    else {
        // redirect to user dashboard
        // return view('user.list');
        return redirect()->route('user#Home');
    }
    }
}
