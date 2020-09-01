<?php

namespace App\Http\Controllers\User;

use App\Order;
use App\OrderItem;
use App\TempOrder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;

class ProductCartController extends Controller
{
   public function add_cart(Request $request){

    $isExist = TempOrder::where('sessionID', Cookie::get('unique_session'))
    ->where('productID', $request->productID)->first();

        if($isExist == null){
            $table = new TempOrder();
            $table->sessionID = Cookie::get('unique_session');
            $table->productID = $request->productID;
            $table->price = $request->price;
            $table->quantity = 1;
            $table->save();
        }else{
            $old_qty = $isExist->quantity;
            TempOrder::where('sessionID', Cookie::get('unique_session'))
            ->where('productID', $request->productID)->update(['quantity' => ($old_qty + 1)]);
        }

        return 0;

   }

   public function remove_cart(Request $request){

    $isExist = TempOrder::where('sessionID', Cookie::get('unique_session'))
    ->where('productID', $request->productID)->first();

    if($isExist != null){
        $old_qty = $isExist->quantity;

        if($old_qty == 1){
            TempOrder::where('sessionID', Cookie::get('unique_session'))
            ->where('productID', $request->productID)->delete();
        }else{
            TempOrder::where('sessionID', Cookie::get('unique_session'))
            ->where('productID', $request->productID)->update(['quantity' => ($old_qty - 1)]);
        }
    }

    return 0;

   }


  public function show_cart(Request $request){
    $isExist = TempOrder::where('sessionID', Cookie::get('unique_session'))
    ->where('productID', $request->productID)->first();

        if($isExist == null){
            $table = new TempOrder();
            $table->sessionID = Cookie::get('unique_session');
            $table->productID = $request->productID;
            $table->price = $request->price;
            $table->quantity = 1;
            $table->save();
        }else{
            $old_qty = $isExist->quantity;
            TempOrder::where('sessionID', Cookie::get('unique_session'))
            ->where('productID', $request->productID)->update(['quantity' => ($old_qty + 1)]);
        }

        return 0;
   }

   public function get_temp_order(){
       $table = TempOrder::where('sessionID', Cookie::get('unique_session'))->sum('quantity');
       return $table;
   }

    public function index(){
        $table = TempOrder::where('sessionID', Cookie::get('unique_session'))->get();
        return view('user.cart')->with(['table' => $table]);
    }

    public function cart_update(Request $request){
        $table = TempOrder::find($request->tempOrderID);
        $table->quantity = $request->quantity;
        $table->save();
        return redirect()->back();
    }

    public function cart_item_del($id){
        $table = TempOrder::find($id);
        $table->delete();
        return redirect()->back();
    }

    public function checkout(){
        $table = TempOrder::where('sessionID', Cookie::get('unique_session'))->get();
        if (count($table) > 0) {
            return view('user.checkout')->with(['table' => $table]);
        }else{
            return redirect()->back()->with(['message' => 'Cart is Empty.']);
        }

    }

    public function confirm_checkout(Request $request){
        $tempTable = TempOrder::where('sessionID', Cookie::get('unique_session'))->where('quantity', '>', 0)->get();


        if(count($tempTable) > 0) {

            $request_date = $request->checkoutDate.' '.$request->deliveryTime;

            $today = date("Y-m-d H:i:s", strtotime("+30 minutes"));

            $today_time = strtotime($today);
            $delivery_time = strtotime($request_date);

            if($delivery_time > $today_time) {

                $temp_amount = 0;

                foreach ($tempTable as $row) {
                    $temp_amount += ($row->quantity * $row->price);
                }
                    $userID = Auth::user()->id;

                    DB::beginTransaction();
                    try {

                        $orders = new Order();
                        $orders->userID = $userID;
                        $orders->deliveryCharge = $request->deliveryCharge;
                        $orders->paidAmount = $temp_amount;
                        $orders->address = $request->deliveryAddress;
                        $orders->contactNo = Auth::user()->contactNo;
                        $orders->paymentType = $request->paymentType;
                        $orders->description = $request->orderInstraction;
                        $orders->deliveryDate = db_date($request->checkoutDate).' '.date('h:i:s', strtotime($request->deliveryTime));
                        $orders->save();

                        $orderID = $orders->orderID;

                        $total_amount = 0;

                        foreach ($tempTable as $row) {
                            //Add to purchase Item Table
                            $order_item = new OrderItem();
                            $order_item->orderID = $orderID;
                            $order_item->productID = $row->productID;
                            $order_item->quantity = $row->quantity;
                            $order_item->price = $row->price;
                            $order_item->save();
                            $total_amount += ($row->quantity * $row->price);

                            //$orderItemID = $order_item->orderItemID;


                        }

                        TempOrder::where('sessionID', Cookie::get('unique_session'))->delete();

                        DB::commit();
                    } catch (\Throwable $e) {
                        DB::rollback();
                        throw $e;
                    }

                    $table = Order::find($orderID);

                    return redirect()->to('/')->with(['message' => 'Your order placed successfully!!']);


        }else {
                return back()->with(['message' => 'Please Select Proper Delivery Date and Time.!!']);
        }


        }else{
            TempOrder::where('sessionID', Cookie::get('unique_session'))->delete();
            return redirect()->to('/');
        }
    }

    public function invoice($id){
        $table = Order::find($id);
        return view('user.print.invoice')->with(['table' => $table]);
    }
}
