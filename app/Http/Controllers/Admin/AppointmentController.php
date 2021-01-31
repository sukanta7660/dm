<?php

namespace App\Http\Controllers\Admin;

use App\Appointment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AppointmentController extends Controller
{
    public function index()
    {
        $table = Appointment::where('status','Unchecked')->get();
        return view('admin.appointment.new',compact('table'));
    }

    public function check($id)
    {
        $table = Appointment::find($id);
        $table->status = 'Checked';
        $table->save();
        return redirect()->back()->with(['success' => 'Checked Successful!']);
    }

    public function del($id)
    {
        $table = Appointment::find($id);
        $table->delete();
        return redirect()->back()->with(['success' => 'Deleted Successful!']);
    }

    public function checked()
    {
        $table = Appointment::where('status','Checked')->get();
        return view('admin.appointment.checked',compact('table'));
    }
}
