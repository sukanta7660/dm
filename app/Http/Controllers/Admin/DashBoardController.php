<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order;
use App\Product;

class DashBoardController extends Controller
{
    public function index(){
        $new_order = Order::where('orderStatus','Pending')->get();
        $complete_order = Order::where('orderStatus','Complete')->get();
        $total_order = Order::all();
        $total_product = Product::all();
        return view('admin.dashboard')->with(['new_order' => $new_order,'complete_order' => $complete_order,'total_product' => $total_product, 'total_order' => $total_order]);
    }
}
