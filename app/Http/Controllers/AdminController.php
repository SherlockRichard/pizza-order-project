<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function adminListPage(){
        $admins = User::when(request('searchKey'),function($query){
            $query->orWhere('name','like','%'.request('serachKey').'%')
            ->orWhere('email','like','%'.request('serachKey').'%')
            ->orWhere('phone','like','%'.request('serachKey').'%')
            ->orWhere('address','like','%'.request('serachKey').'%');


        })
        ->where('role','admin')
        ->paginate(5);

        $admins->appends(request()->all());
        return view('admin.account.list',compact('admins'));
    }

    // delete admin
    public function adminDelete($id){
       User::where('id',$id)->delete();
       return back()->with(['deleteSuccess' => 'Admin account has been deleted sucessfully!']);

    }
    // go to change role
    public function changeRolePage($id){
        $account = User::where('id',$id)->first();
        return view('admin.account.changeRole',compact('account'));
    }

    //go to change Role
    public function changeRole(Request $request,$id){
       User::where('id',$id)->update(['role'=>$request->role]);
       return redirect()->route('admin#adminListPage')->with(['updateSuccess'=>'Account has been changed successfully!']);
    }
}
