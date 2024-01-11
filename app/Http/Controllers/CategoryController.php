<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{

    //go to category page
    public function listPage(){
        $data = Category::orderBy('created_at','desc')->get();

        return view('admin.category.list',compact('data'));
    }
    //go to create category page
    public function createPage(){
        return view('admin.category.create');
    }

    //create category
    public function create(Request $request){
        $this->validateCategory($request);
      $data  =  $this->getRequestData($request);
        Category::create($data);
        return redirect()->route('admin#categorylist');

    }
///....................Private Function............//

private function validateCategory(Request $request){
    $validationRules = [
        'categoryName' => 'required|unique:categories,name'
    ];
    Validator::make($request->all(),$validationRules)->validate();
}

   private function getRequestData(Request $request){
    return[
        'name' => $request->categoryName
    ];
   }
}
