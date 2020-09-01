<?php

namespace App\Http\Controllers\Admin\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order;
use App\User;

class CustomerController extends Controller
{
    public function index(){
        $table = User::orderBy('created_at','DESC')->where('userType','!=','Admin')->get();
        return view('admin.customers.customers')->with(['table' => $table]);
    }
    public function admin(){
        $table = User::orderBy('created_at','DESC')->where('userType','=','Admin')->get();
        return view('admin.admin.admin')->with(['table' => $table]);
    }

    public function make(Request $request){
        $table = User::find($request->id);
        $table->userType = $request->userType;
        $table->save();
        return redirect()->back();
    }

    public function overview($id){
        $table = User::find($id);
        $orders = Order::orderBy('created_at','DESC')->where('userID',$id)->get();
        return view('admin.customers.overview')->with(['table' => $table, 'orders' => $orders]);
    }
}
