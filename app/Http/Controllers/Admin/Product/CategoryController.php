<?php

namespace App\Http\Controllers\Admin\Product;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index(){
        $table = Category::orderBy('categoryID', 'ASC')->get();
        return view('admin.product.category')->with(['table' => $table]);
    }

    public function save(Request $request){
        $table = new Category();
        $validate = $request->validate([
            'name' => 'required | unique:categories,name',
        ]);

        $table->name = $request->name;
        $table->save();
        return redirect()->back()->with('success','Category added Successfully!!');
    }

    public function edit(Request $request){
        $table = Category::find($request->id);
        $validate = $request->validate([
            'name' => 'required | unique:categories,name',
        ]);
        $table->name = $request->name;
        $table->save();
        return redirect()->back()->with('success','Category edited Successfully!!');
    }

    public function del($id){
        $table = Category::find($id);
        $table->delete();
        return redirect()->back()->with('success','Category deleted Successfully!!');
    }
}
