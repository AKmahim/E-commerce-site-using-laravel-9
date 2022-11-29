<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Brand;
use Image;
use Carbon\Carbon;



class ProductController extends Controller
{
    //this is admin product controller
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        return view('admin.product.index');
    }

    // ============== add product ============
    public function AddProduct(){
        $categories = Category::get();
        $brands = Brand::get();
        return view('admin.product.add',compact('categories','brands'));
    }
    public function StoreData(Request $request){
        // dd($request->all());
        $request->validate([
            'product_name'=> 'required|max:255',
            'product_code'=> 'required|max:255',
            'price'=> 'required|max:255',
            'product_quantity'=> 'required|max:255',
            'category_id'=> 'required|max:255',
            'brand_id' => 'required|max:255',
            'short_description'=> 'required|max:255',
            'long_description'=> 'required',
            'image_one'=> 'required|mimes:jpg,jpeg,png,gif',
            'image_two'=> 'required|mimes:jpg,jpeg,png,gif',
            'image_three'=> 'required|mimes:jpg,jpeg,png,gif',

        ],[
            // custom required field setup
            'category_id.required'=>'select category name',
            'brand_id.required'=>'select brand name',



        ]);

        //image upload setup for image one or thumbail
        $image_one = $request->file('image_one');
        $name_gen = hexdec(uniqid()).'.'.$image_one->getClientOriginalExtension();
        Image::make($image_one)->resize(270,270)->save('frontend/img/product/upload/'.$name_gen);
        $img_url1 = 'frontend/img/product/upload/'.$name_gen;

        //image upload setup for image two
        $image_two = $request->file('image_two');
        $name_gen = hexdec(uniqid()).'.'.$image_two->getClientOriginalExtension();
        Image::make($image_two)->resize(270,270)->save('frontend/img/product/upload/'.$name_gen);
        $img_url2 = 'frontend/img/product/upload/'.$name_gen;

        //image upload setup for image three

        $image_three = $request->file('image_three');
        $name_gen = hexdec(uniqid()).'.'.$image_three->getClientOriginalExtension();
        Image::make($image_three)->resize(270,270)->save('frontend/img/product/upload/'.$name_gen);
        $img_url3 = 'frontend/img/product/upload/'.$name_gen;


        Product::insert([
            'category_id' => $request->category_id,
            'brand_id'=> $request->brand_id,
            'product_name'=>$request->product_name,
            'product_slug' => strtolower(str_replace(' ','-',$request->product_name)),
            'product_code' => $request->product_code,
            'price' => $request->price,
            'product_quantity' => $request->product_quantity,
            'short_description' => $request->short_description,
            'long_description' => $request->long_description,
            'image_one' => $img_url1,
            'image_two' => $img_url2,
            'image_three' => $img_url3,
            'created_at' => Carbon::now(),


        ]);
        return Redirect()->back()->with('success','Product Inserted');

    }
}
