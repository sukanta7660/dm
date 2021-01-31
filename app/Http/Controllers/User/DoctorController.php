<?php

namespace App\Http\Controllers\User;

use App\Appointment;
use App\Department;
use App\Doctor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DoctorController extends Controller
{
    public function index()
    {
        $table = Doctor::all();
        $depts = Department::all();
        return view('user.doctor',compact('table','depts'));
    }
    public function department_wise($id)
    {
        $dept = Department::find($id);
        $depts = Department::all();
        $table = Doctor::where('department_id',$dept->id)->get();
        return view('user.department-wise',compact('table','depts','dept'));

    }

    public function appointment_page($id)
    {
        $table = Doctor::find($id);
        return view('user.appointment',compact('table'));
    }

    public function get_appointment(Request $request)
    {
        //dd($request->all());

        $appointment = new Appointment();
        $appointment->name = $request->name;
        $appointment->patient_Age = $request->patient_Age;
        $appointment->address = $request->address;
        $appointment->number = $request->number;
        $appointment->description = $request->description;
        $appointment->doctor_id = $request->doctor_id;
        $appointment->save();
        return redirect()->back()->with(['message' => 'Appointment request placed successfully!']);
    }
}
