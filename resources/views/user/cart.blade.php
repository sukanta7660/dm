@extends('layouts.master')
@section('title')
    Cart
@endsection
@section('content')
    <div class="hero-wrap hero-bread" style="background-image: url({{asset('public/user_asset/images/bg_6.jpg')}});">
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate text-center">
                    <p class="breadcrumbs"><span class="mr-2"><a href="#">Home</a></span> <span>Cart</span></p>
                    <h1 class="mb-0 bread">My Cart</h1>
                </div>
            </div>
        </div>
    </div>
    <section class="ftco-section ftco-cart">
        <div class="container">
            <div class="row">
                <div class="col-md-4 btn_mod">
                    @if(session()->has('message'))
                        <div class="alert alert-danger">
                            {{ session()->get('message') }}
                        </div>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 ftco-animate">
                    <div class="cart-list">
                        <table class="table">
                            <thead class="thead-primary">
                            <tr class="text-center">
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($table as $row)

                            @php
                                $price = $row->price;
                                $qty = $row->quantity;
                                $total_amount = $price * $qty;
                            @endphp
                            <form action="{{action('User\ProductCartController@cart_update')}}" method="post" enctype="multipart/form-data">
                            <tr class="text-center">
                                <td class="product-remove">
                                    {{@csrf_field()}}
                                    <input type="hidden" name="tempOrderID" value="{{$row->tempOrderID}}">
                                <a title="Remove from cart" onclick="return confirm('Are you sure to delete?')" href="{{action('User\ProductCartController@cart_item_del',['id' => $row->tempOrderID])}}"><span class="ion-ios-close"></span></a> &nbsp;
                                    <button title="Update quantity" style="bordeR: 1px solid rgba(0, 0, 0, 0.1);padding: 4px 8px;/*! color: #000000; */border-radius: 0px;height: 32px!important;" class="btn bt-default" onclick="return confirm('Dou you want to update quantity?')" type="submit"><span class="ion-ios-timer"></span></button>
                                </td>

                            <td class="image-prod"><img src="{{ck_file('products', 'public/uploads/products', 'sm_'.$row->product['imageName'], 'sm')}}" alt=""></td>

                                <td class="product-name">
                                    <h3>{{$row->product['name']}}</h3>
                                </td>

                                <td class="price">{{money($row->price)}}</td>

                                <td class="quantity">
                                    <div class="input-group mb-3">
                                        <input type="number" name="quantity" class="quantity form-control input-number" value="{{$row->quantity}}" min="1" max="100">
                                    </div>
                                </td>

                                <td class="total">{{money($total_amount)}}</td>
                            </tr>
                            </form>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
                    @php
                        $total = 0;
                    @endphp
                    @foreach($table as $row)
                        @php
                            $total += ($row->price * $row->quantity);
                        @endphp
                    @endforeach
                    @php
                    if($total > 300)
                    $g_total = $total+config('sp.dCharge');
                    else
                    $g_total = $total+config('sp.dChargeadd');
                    @endphp
            <div class="row justify-content-center">
                <div class="col col-lg-5 col-md-6 mt-5 cart-wrap ftco-animate">
                    <div class="cart-total mb-3">
                        <h3>Cart Totals</h3>
                        <p class="d-flex">
                            <span>Subtotal</span>
                            <span>{{money($total)}}</span>
                        </p>
                        <p class="d-flex">
                            <span>Delivery</span>
                            <span>
                                @if($total > 300)
                                {{money(config('sp.dCharge'))}}
                                @else
                                {{money(config('sp.dChargeadd'))}}
                                @endif
                            </span>
                        </p>
                        <hr>
                        <p class="d-flex total-price">
                            <span>Total</span>
                            <span>
                                {{money($g_total)}}
                            </span>
                        </p>
                    </div>
                    <p class="text-center"><a href="{{action('User\ProductCartController@checkout')}}" class="btn btn-primary py-3 px-4">Proceed to Checkout</a></p>
                </div>
            </div>
        </div>
    </section>
@endsection
