<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductsController extends Controller
{
    //go to product list page
    public function listPage(){
    $products = Products::select('products.*','categories.name as category_name')
             ->when(request('searchKey'),function($query){
            $query->where('products.name','like','%'.request('searchKey').'%');
           })
           ->leftJoin('categories','products.category_id','categories.id')
            // ->orderBy('created_at','desc'),
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

    // Product Details page

    public function details($id){
        $products = Products::where('id',$id)->first();

        return view('admin.product.details',compact('products'));
    }

    //Product edit Page
    public function editPage($id){
        $products = Products::where('id',$id)->first();
         $categories = Category::select('id','name')->get();
        return view('admin.product.editpage',compact('products','categories'));
    }
    //product edit
     public function edit($id,Request $req){
        // edit validation

        $validationRules =[
           'pizzaName'          => 'required|unique:products,name,'.$id,
            'pizzaCategory'      => 'required',
            'pizzaDescription'   => 'required',
            'pizzaWaitingTime'   => 'required',
            'pizzaPrice'         => 'required',
            'pizzaImage'         => 'mimes:jpg,jpeg,png,webp|file',

        ];
        Validator::make($req->all(),$validationRules)->validate();

        $products =$this->getProducts($req);

        if($req->hasFile('pizzaImage')){
            $dbImage = Products::where('id',$id)->first();
            $dbImage = $dbImage->image;

            //if image is already exist


            Storage::delete('public/'.$dbImage);


            $fileName= uniqid().$req->file('image')->getClientOriginalName();
            $req->file('image')->storeAs('public',$fileName);
            $products['image'] = $fileName;
        }

        Products::where('id',$id)->update($products);
        return redirect()->route('admin#productList')->with(['updateSucess'=>'Product Update Sucessfully!']);


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

            'waiting_time' => $req->pizzaWaitingTime,
            'price'    => $req->pizzaPrice,

        ];
    }
}
