<?php

namespace App\Http\Controllers\Admin;

use App\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DepartmentController extends Controller
{
    public function index(){
        $table = Department::all();
        return view('admin.doctor.department',compact('table'));
    }

    public function store(Request $request){
        $table = new Department();
        $table->dept_Name = $request->name;
        $table->slug = str_slug($request->name);
        $table->save();
        return redirect()->back();
    }

    public function edit(Request $request){
        $table = Department::find($request->id);
        $table->dept_Name = $request->name;
        $table->slug = str_slug($request->name);
        $table->save();
        return redirect()->back();
    }

    public function del($id){
        $table = Department::find($id);
        $table->delete();
        return redirect()->back();
    }
}
