@extends('layouts.master')
@section('title')
    Checkout
@endsection
@section('content')
    <div class="hero-wrap hero-bread" style="background-image: url({{asset('public/user_asset/images/bg_6.jpg')}});">
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate text-center">
                    <p class="breadcrumbs"><span class="mr-2"><a href="#">Home</a></span> <span>Checkout</span></p>
                    <h1 class="mb-0 bread">Checkout</h1>
                </div>
            </div>
        </div>
    </div>
    <section class="ftco-section">
        <div class="container">
        <div class="row justify-content-center">
                <div class="col-md-6 btn_mod">
                    @if(session()->has('message'))
                        <div class="alert alert-danger">
                            {{ session()->get('message') }}
                        </div>
                    @endif
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-xl-8 ftco-animate">
                    <form action="{{action('User\ProductCartController@confirm_checkout')}}" method="POST" enctype="multipart/form-data" class="billing-form">
                        {{csrf_field()}}
                        <h3 class="mb-4 billing-heading">Checkout Details</h3>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><i class="icon-pin-alt"></i> Delivery Address:</label>
                                <textarea rows="3" cols="5" name="deliveryAddress" class="form-control" placeholder="Enter Delivery Address Here ...">{{Auth::user()->address}}</textarea>
                                </div>
                                <div class="form-group">
                                        <label><i class="icon-pushpin"></i> Order Instructions:</label>
                                        <textarea rows="3" cols="5" name="orderInstraction" class="form-control" placeholder="Example: Before delivery please call me first."></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label><i class="icon-pushpin"></i> Contact No:</label>
                                    <input name="contactNo" class="form-control" placeholder="Example: contact no" value="{{Auth::user()->contactNo}}" type="text">
                                    </div>
                            </div>
                            <div class="col-md-6">
                                    <div class="form-group">
                                            <label><i class="icon-calendar2"></i> Preferred Delivery Date:</label>
                                            <input type="date" name="checkoutDate" id="icon-calendar2" class="form-control" value="{{date('Y-m-d')}}">
                                            {{-- <select name="checkoutDate" class="form-control">
                                                @for($i = 0; $i<config('sp.delivery'); $i++)
                                                    @php
                                                        $date = strtotime("+".$i." day", strtotime(date("Y-m-d")));
                                                    @endphp

                                                    <option value="{{date('Y-m-d', $date)}}">{{date('F d, Y', $date)}}</option>
                                                @endfor

                                            </select> --}}
                                        </div>
                                        <div class="form-group">
                                                <label><i class="icon-watch2"></i> Preferred Delivery Time:</label>
                                                <select name="deliveryTime" class="form-control">
                                                    <option value="{{date('H:i:s', strtotime('08:00 am'))}}">{{date('h:i a', strtotime('08:00 am'))}} - {{date('h:i a', strtotime('09:00 am'))}}</option>
                                                    <option value="{{date('H:i:s', strtotime('09:00 am'))}}">{{date('h:i a', strtotime('09:00 am'))}} - {{date('h:i a', strtotime('10:00 am'))}}</option>
                                                    <option value="{{date('H:i:s', strtotime('10:00 am'))}}">{{date('h:i a', strtotime('10:00 am'))}} - {{date('h:i a', strtotime('11:00 am'))}}</option>
                                                    <option value="{{date('H:i:s', strtotime('11:00 am'))}}">{{date('h:i a', strtotime('11:00 am'))}} - {{date('h:i a', strtotime('12:00 pm'))}}</option>
                                                    <option value="{{date('H:i:s', strtotime('12:00 pm'))}}">{{date('h:i a', strtotime('12:00 pm'))}} - {{date('h:i a', strtotime('01:00 pm'))}}</option>
                                                    <option value="{{date('H:i:s', strtotime('01:00 pm'))}}">{{date('h:i a', strtotime('01:00 pm'))}} - {{date('h:i a', strtotime('02:00 pm'))}}</option>
                                                    <option value="{{date('H:i:s', strtotime('02:00 pm'))}}">{{date('h:i a', strtotime('02:00 pm'))}} - {{date('h:i a', strtotime('03:00 pm'))}}</option>
                                                    <option value="{{date('H:i:s', strtotime('03:00 pm'))}}">{{date('h:i a', strtotime('03:00 pm'))}} - {{date('h:i a', strtotime('04:00 pm'))}}</option>
                                                    <option value="{{date('H:i:s', strtotime('04:00 pm'))}}">{{date('h:i a', strtotime('04:00 pm'))}} - {{date('h:i a', strtotime('05:00 pm'))}}</option>
                                                    <option value="{{date('H:i:s', strtotime('05:00 pm'))}}">{{date('h:i a', strtotime('05:00 pm'))}} - {{date('h:i a', strtotime('06:00 pm'))}}</option>
                                                    <option value="{{date('H:i:s', strtotime('06:00 pm'))}}">{{date('h:i a', strtotime('06:00 pm'))}} - {{date('h:i a', strtotime('07:00 pm'))}}</option>
                                                    <option value="{{date('H:i:s', strtotime('07:00 pm'))}}">{{date('h:i a', strtotime('07:00 pm'))}} - {{date('h:i a', strtotime('08:00 pm'))}}</option>
                                                    <option value="{{date('H:i:s', strtotime('08:00 pm'))}}">{{date('h:i a', strtotime('08:00 pm'))}} - {{date('h:i a', strtotime('09:00 pm'))}}</option>
                                                </select>
                                            </div>
                                        @php
                                            $total = 0;
                                           foreach($table as $row){
                                            $total += ($row->price * $row->quantity);
                                           }
                                       @endphp
                                        @if($total > 300)
                                        <p><i class="icon-info"></i> Delivery Charge <strong class="text-success text-black">FREE !!</strong></p>
                                            <input type="hidden" name="deliveryCharge" value="{{config('sp.dCharge')}}">
                                            @else
                                            <p><i class="icon-info22"></i> Delivery Charge <strong class="text-danger text-black">{{money(config('sp.dChargeadd'))}}</strong> only</p>
                                            <input type="hidden" name="deliveryCharge" value="{{config('sp.dChargeadd')}}">
                                        @endif
                            </div>
                        </div>


                    <div class="row mt-5 pt-3 d-flex">
                        <div class="col-md-6 d-flex">
                            <div class="cart-detail cart-total bg-light p-3 p-md-4">
                                <h3 class="billing-heading mb-4">Cart Total</h3>
                                <p class="d-flex">
                                    <span>Subtotal</span>
                                    <span>{{money($total)}}</span>
                                </p>
                                <p class="d-flex">
                                    <span>Delivery</span>
                                    <span>
                                        @if($total > 300)
                                        {{money(0)}}
                                        @else
                                        {{money(20)}}
                                        @endif
                                    </span>
                                </p>
                                <hr>
                                @php
                                    $sub_total = $total;
                                    //$delivery_charge = config('sp.dCharge');

                                    if($sub_total > 300){
                                        $grand_total = ($sub_total + 0);
                                    }
                                    else {
                                        $grand_total = ($sub_total + 20);
                                    }
                                @endphp
                                <p class="d-flex total-price">
                                    <span>Total</span>
                                    <span>{{money($grand_total)}}</span>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="cart-detail bg-light p-3 p-md-4">
                                <h3 class="billing-heading mb-4">Payment Method</h3>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <div class="radio">
                                            <label><input type="radio" name="paymentType" value="cash" class="mr-2 mb-5" checked>Cash On Delivery</label>
                                            <label><input type="radio" name="paymentType" value="cash" class="mr-2 mb-5" checked>bkash</label>
                                        </div>
                                    </div>
                                </div>
                                <p><button type="submit" class="btn btn-primary py-3 px-4 mt-5">Place an order</button></p>
                            </div>
                        </div>
                    </div>
                    </form>
                </div> <!-- .col-md-8 -->
            </div>
        </div>
    </section> <!-- .section -->
@endsection
