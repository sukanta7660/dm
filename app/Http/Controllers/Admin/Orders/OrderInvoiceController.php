<?php

namespace App\Http\Controllers\Admin\Orders;
use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderInvoiceController extends Controller
{
    public function index($id){
        $table = Order::find($id);
        return view('admin.preview.overview')->with(['table' => $table]);
    }

    public function invoice($id){
        $table = Order::find($id);
        return view('admin.preview.invoice')->with(['table' => $table]);
    }
}
