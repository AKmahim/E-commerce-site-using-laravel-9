<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Carbon\Carbon;
class CategoryController extends Controller
{
    //this category controller 
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $categories = Category::latest()->get();
        return view('admin.category.index',compact('categories'));
    }
    public function StoreData(Request $request){
        // dd($request->all());
        $request->validate([
            'category_name'=>'required|unique:categories,category_name'
        ]);



        Category::insert([
            'category_name' => $request->category_name,
            'created_at' => Carbon::now()
            
        ]);

        return redirect()->back();
    }

    public function Delete($id){
        $delete = Category::find($id)->delete();
        return Redirect()->back()->with('delete','Category Deleted');
    }

    public function Activies($id){
        $c = Category::find($id);
        if($c->status == 0){
            $update = Category::find($id)->update([
                'status'=> 1
            ]);
            return Redirect()->back()->with('delete','Category active');
        }
        else{
            $update = Category::find($id)->update([
                'status'=> 0
            ]);
            return Redirect()->back()->with('delete','Category Inactive');

        }
        
    }


    public function Edit($id){
         $category = Category::find($id);
         return view('admin.category.edit',compact('category'));
    }

    public function UpdateCategory(Request $request){
        // $cat = Category::find($request->id);
        $update = Category::find($request->id)->update([
            'category_name' => $request->category_name
        ]);
        return Redirect()->route('admin.category')->with('delete','Category Updated');
        
    }



}
