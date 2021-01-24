<?php

namespace App\Http\Controllers\Admin;

use App\Department;
use App\Doctor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DoctorController extends Controller
{
    public function index(){
        $table = Doctor::all();
        $depts = Department::all();
        return view('admin.doctor.doctor',compact('table','depts'));
    }

    public function store(Request $request){
        $doctor = new Doctor();
        $doctor->department_id = $request->department_id;
        $doctor->name = $request->name;
        $doctor->degrees = $request->degrees;
        $doctor->checkFee = $request->checkFee;
        $doctor->chamberDetails = $request->chamberDetails;
        $doctor->mobileNo = $request->mobileNo;
        $doctor->time = $request->time;
        $doctor->description = $request->description;
        $doctor->specialist = $request->specialist;
        if ($request -> hasFile('imageName')) {
            $extension = $request->imageName->extension();
            $fileName = str_slug($request ->name,'_').'_'.md5(date('Y-m-d H:i:s'));
            $fileName = $fileName.'.'.$extension;
            $doctor -> imageName = $fileName;
            $request -> imageName-> move('public/uploads/doctor',$fileName);
        }
        $doctor->save();
        return redirect()->back();
    }

    public function edit(Request $request){
        $doctor = Doctor::find($request->id);
        $doctor->department_id = $request->department_id;
        $doctor->name = $request->name;
        $doctor->degrees = $request->degrees;
        $doctor->checkFee = $request->checkFee;
        $doctor->chamberDetails = $request->chamberDetails;
        $doctor->mobileNo = $request->mobileNo;
        $doctor->time = $request->time;
        $doctor->description = $request->description;
        $doctor->specialist = $request->specialist;
        if ($request -> hasFile('imageName')) {
            $extension = $request->imageName->extension();
            $fileName = str_slug($request ->name,'_').'_'.md5(date('Y-m-d H:i:s'));
            $fileName = $fileName.'.'.$extension;
            $doctor -> imageName = $fileName;
            $request -> imageName-> move('public/uploads/doctor',$fileName);
        }
        $doctor->save();
        return redirect()->back();
    }

    public function del($id){
        $table = Doctor::find($id);
        $table->delete();
        return redirect()->back();
    }
}
