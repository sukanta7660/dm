@extends('layouts.master')
@section('title')
    {{Auth::user()->name}}
@endsection
@section('content')
    <div class="hero-wrap hero-bread" style="background-image: url({{asset('public/user_asset/images/bg_6.jpg')}});">
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate text-center">
                    <p class="breadcrumbs"><span class="mr-2"><a href="#">Home</a></span> <span>Profile</span></p>
                    <h1 class="mb-0 bread">Profile</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="container pl-0">
        <div class="profile_main">
            <div class="row">
                <div class="col-md-3">
                    <div class="profile_side">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="profile_picture text-center mt-3">
                                    <div class="profile-img">
                                        @if( Auth::user()->imageName != null )
                                            <img src="{{asset('public/uploads/profile/'.Auth::user()->imageName)}}" alt="profile picture"/>
                                        @else
                                            <img class="user_image" src="{{asset('public/profile/user/user.png')}}" alt="user image">
                                        @endif
                                    </div>
                                    <div class="profile_info">
                                        <h3 class="profile_name">
                                            <span class="p-name">{{Auth::user()->name}}</span>
                                        </h3>
                                        <p class="user_dept"><i class="icon-phone"></i>&nbsp;
                                            {{Auth::user()->contactNo}}
                                        </p>
                                        <p class="user_dept"><i class="icon-envelope"></i>&nbsp;
                                            {{Auth::user()->email}}
                                        </p>
                                        <p class="address_user"><i class="icon-location-arrow"></i>&nbsp; {{Auth::user()->address}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button style="width: 100%;padding: 0px 0;margin-top: 10px; font-size: 13px;" type="button" class="btn btn-info" data-toggle="collapse" title="edit profile" data-target="#editprofile">Edit Profile</button>
                                <button style="width: 100%;padding: 0px 0;margin-top: 10px; font-size: 13px;" type="button" class="btn btn-info" data-toggle="collapse" title="password change" data-target="#change_pass">Change Password</button>

                                <div id="editprofile" class="collapse">
                                    <form action="{{action('User\ProfileController@update')}}" class="mt-3 text-center" method="post" enctype="multipart/form-data">
                                        {{csrf_field()}}
                                        <input type="hidden" name="id" value="{{Auth::user()->id}}">
                                        <div class="form-group row justify-content-md-center mb-1">
                                            <div class="col-sm-10">
                                                <input value="{{Auth::user()->name}}" name="name" type="text" class="form-control form-control-sm"  placeholder="name">
                                            </div>
                                        </div>
                                        <div class="form-group row justify-content-md-center mb-1">
                                            <div class="col-sm-10">
                                                <input value="{{Auth::user()->address}}" name="address" type="text" class="form-control form-control-sm"  placeholder="address">
                                            </div>
                                        </div>
                                        <div class="form-group row justify-content-md-center mb-1">
                                            <div class="col-sm-10">
                                                <input value="{{Auth::user()->contactNo}}" name="contactNo" type="text" class="form-control form-control-sm"  placeholder="contact No">
                                            </div>
                                        </div>
                                        <div class="form-group row justify-content-md-center mb-1">
                                            <div class="col-sm-10">
                                                <input value="{{Auth::user()->email}}" name="email" type="email" class="form-control form-control-sm"  placeholder="email">
                                            </div>
                                        </div>
                                        <div class="form-group row justify-content-md-center mb-1">
                                            <div class="col-sm-10">
                                                <input style="padding-top: 0;" name="imageName" type="file" class="form-control form-control-sm">
                                            </div>
                                        </div>
                                        <div class="form-group row justify-content-md-center mb-1">
                                            <div class="col-sm-10">
                                                <button type="submit" style="padding: 0;font-size: 13px;" class="btn btn-info form-control form-control-sm" value="Save Changes">Save Changes</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div id="change_pass" class="collapse">
                                    <form action="{{action('User\ProfileController@change_pass')}}" class="mt-3 text-center" method="post" enctype="multipart/form-data">
                                        {{csrf_field()}}
                                        <input type="hidden" name="id" value="{{Auth::user()->id}}">
                                        <div class="form-group row justify-content-md-center mb-1">
                                            <div class="col-sm-10">
                                                <input name="current_password" type="password" class="form-control form-control-sm"  placeholder="current_password">
                                            </div>
                                        </div>
                                        <div class="form-group row justify-content-md-center mb-1">
                                            <div class="col-sm-10">
                                                <input name="new_password" type="password" class="form-control form-control-sm"  placeholder="new password">
                                            </div>
                                        </div>
                                        <div class="form-group row justify-content-md-center mb-1">
                                            <div class="col-sm-10">
                                                <input  name="confirm_password" type="password" class="form-control form-control-sm"  placeholder="confirm password">
                                            </div>
                                        </div>
                                        <div class="form-group row justify-content-md-center mb-1">
                                            <div class="col-sm-10">
                                                <button type="submit" style="padding: 0;font-size: 13px;" class="btn btn-info form-control form-control-sm" value="Save Changes">Change Password</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                        <hr>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="container">
                        {{--Comment Section--}}
                        <div class="row mt-5 mb-5">
                            <div class="col-md-12">
                                @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if ($message = Session::get('message'))
                        <div class="alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                        </div>

                    @endif
                    @if ($message = Session::get('error'))
                        <div class="alert alert-danger alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                        </div>

                    @endif
                            </div>
                            <div class="col-md-12">
                                <div class="card card-body">
                                    <h2>Your Orders</h2>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table class="table">
                                                <thead class="thead-primary">
                                                <tr class="text-center">
                                                    <th>Date</th>
                                                    <th>OrderNo</th>
                                                    <th>Delivery Date</th>
                                                    <th>Total</th>
                                                    <th>Status</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($table as $row)
                                                        <tr class="text-center">
                                                            <td class="image-prod">{{pub_date($row->created_at)}}</td>
                                                            <td class="product-name"><a href="{{action('User\ProductCartController@invoice',['id' => $row->orderID])}}">#{{invoice_n($row->orderID)}}</a></td>
                                                            <td class="{{(ends_with(remain_time($row->deliveryDate), 'before')? 'text-danger':'text-green')}}">{{remain_time($row->deliveryDate)}}</td>
                                                            <td class="quantity">{{money($row->paidAmount)}}</td>
                                                            <td class="quantity">
                                                                @if($row->orderStatus=='Pending')
                                                                <span class="text-warning">
                                                                    {{$row->orderStatus}}
                                                                </span>
                                                                @elseif($row->orderStatus=='Processing')
                                                                <span class="text-info">
                                                                    {{$row->orderStatus}}
                                                                </span>
                                                                @elseif($row->orderStatus=='Completed')
                                                                <span class="text-success">
                                                                    {{$row->orderStatus}}
                                                                </span>
                                                                @elseif($row->orderStatus=='Cancelled')
                                                                <span class="text-danger">
                                                                    {{$row->orderStatus}}
                                                                </span>
                                                                @endif

                                                            </td>
                                                        </tr>
                                                 @endforeach
                                                </tbody>
                                            </table>
                                            {{$table->links()}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{--Comment Section--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
