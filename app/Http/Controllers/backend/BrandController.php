<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use Carbon\Carbon;

class BrandController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $brands = Brand::latest()->get();
        return view('admin.brand.index',compact('brands'));
    }
    public function StoreData(Request $request){
        $request->validate([
            'brand_name'=>'required|unique:brands,brand_name'
        ]);



        Brand::insert([
            'brand_name' => $request->brand_name,
            'created_at' => Carbon::now()
            
        ]);

        return redirect()->back()->with('delete','Data Inserted');
    }

    public function Delete($id){
        $delete = Brand::find($id)->delete();
        return Redirect()->back()->with('delete','Brand Deleted');
    }

    public function Activies($id){
        $c = Brand::find($id);
        if($c->status == 0){
            $update = Brand::find($id)->update([
                'status'=> 1
            ]);
            return Redirect()->back()->with('delete','Brand active');
        }
        else{
            $update = Brand::find($id)->update([
                'status'=> 0
            ]);
            return Redirect()->back()->with('delete','Brand Inactive');

        }
        
    }

    public function Edit($id){
        $brand = Brand::find($id);
        return view('admin.brand.edit',compact('brand'));
    }


    public function UpdateBrand(Request $request){
        // $cat = Category::find($request->id);
        $update = Brand::find($request->id)->update([
            'brand_name' => $request->brand_name
        ]);
        return Redirect()->route('admin.brand')->with('delete','Brand Updated');
        
    }

}
