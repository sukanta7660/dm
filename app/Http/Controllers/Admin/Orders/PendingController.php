<?php

namespace App\Http\Controllers\Admin\Orders;
use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PendingController extends Controller
{
    public function index(){

        $table = Order::orderBy('deliveryDate', 'DESC')->where('orderStatus', config('sp.pending'))->get();

        return view('admin.orders.new_orders')->with(['table' => $table]);
    }

    public function process(){
        $table = Order::orderBy('deliveryDate', 'DESC')->where('orderStatus', config('sp.process'))->get();
        return view('admin.orders.process')->with(['table' => $table]);
    }

    public function cancel(){
        $table = Order::orderBy('deliveryDate', 'DESC')->where('orderStatus', config('sp.cancel'))->get();
        return view('admin.orders.cancelled')->with(['table' => $table]);
    }

    public function process_order($id){
        $table = Order::find($id);
        $table->orderStatus = 'Processing';
        $table->save();
        return redirect()->back();
    }

    public function cancelled($id){
        $table = Order::find($id);
        $table->orderStatus = 'Cancelled';
        $table->save();
        return redirect()->back();
    }

    public function complete(){
        $table = Order::orderBy('deliveryDate', 'DESC')->where('orderStatus', config('sp.complete'))->get();
        return view('admin.orders.complete')->with(['table' => $table]);
    }
    public function complete_order($id){
            $table = Order::find($id);
            $table->orderStatus = 'Completed';
            $table->save();
            return redirect()->back();
    }
}
