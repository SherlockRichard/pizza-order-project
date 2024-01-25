<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductsController extends Controller
{
    //go to product list page
    public function listPage(){
    $products = Products::when(request('searchKey'),function($query){
            $query->where('name','like','%'.request('searchKey').'%');        })
        ->orderBy('created_at','desc')
        ->paginate(3);
        $products -> appends(request()->all());
        return view('admin.product.list',compact('products'));
    }
    //go to products create page
    public function createPage(){
        //get all the categories from category_table
        $categories = Category::select('id','name')->get();
        return view('admin.product.create',compact('categories'));
    }

    //create a product
    public function create(Request $req){
        $this->ValidateProducts($req);
        $data = $this->getProducts($req);

        $fileName = uniqid().$req->file('pizzaImage')->getClientOriginalName();
        $req->file('pizzaImage')->storeAs('public',$fileName);
        $data['image'] = $fileName;

        Products::create($data);
        return redirect()->route('admin#productList');

    }
    // delete Product

    public function delete($id){
        Products::where('id',$id)->delete();
        return back()->with(['deleteSuccess'=> 'product deleted successfully!']);
    }

    // Validation products

    private function ValidateProducts( $req){
        Validator::make($req->all(),[
            'pizzaName'          => 'required|unique:products,name',
            'pizzaCategory'      => 'required',
            'pizzaDescription'   => 'required',
            'pizzaWaitingTime'   => 'required',
            'pizzaPrice'         => 'required',
            'pizzaImage'         => 'required|mimes:jpg,jpeg,png,webp',

        ])->validate();
    }

    private function getProducts($req){
        return[

            'name' => $req->pizzaName,
            'category_id' => $req->pizzaCategory,
            'description' => $req->pizzaDescription,
            'image'   => $req->pizzaImage,
            'waiting_time' => $req->pizzaWaitingTime,
            'price'    => $req->pizzaPrice,

        ];
    }
}
