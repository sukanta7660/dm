@extends('layouts.general')
@section('title')
    Order Overview
@endsection

@section('back-url')
    <div class="col-xs-12">
        <button style="margin-left: -80px;" type="button" class="btn btn-danger btn-md heading-btn print-hide" onclick="history.go(-1)"><i class="fa fa-arrow-left position-left"></i> Go Back</button>
    </div>
@endsection
@section('content')
<div class="row">
        <div class="col-md-6">
            <table class="table table-bordered table-striped table-condensed table-hover">
                <tbody>
                    <tr>
                        <th colspan="2">
                            <h5 class="text-center no-margin">Order Summery</h5>
                        </th>
                    </tr>
                    <tr>
                        <th>Oder ID</th>
                        <td class="text-muted">#{{invoice_n($table->orderID)}}</td>
                    </tr>
                    <tr>
                        <th>Delivery Date</th>
                        <td class="text-semibold text-violet">{{pub_date_month($table->deliveryDate)}} <small class="text-success">{{pub_time($table->deliveryDate)}}</small></td>
                    </tr>
                    <tr>
                        <th>Remaining</th>
                        <td class="{{(ends_with(remain_time($table->deliveryDate), 'before')? 'text-danger':'text-green')}}">{{remain_time($table->deliveryDate)}}</td>
                    </tr>
                    <tr>
                        <th>Address</th>
                        <td class="text-muted">{{$table->address}}</td>
                    </tr>
                    <tr>
                        <th>Order Date</th>
                        <td class="text-muted">{{pub_date_month($table->created_at)}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-6">
            <table class="table table-bordered table-striped table-condensed table-hover">
                <tbody>
                <tr>
                    <th colspan="2">
                        <h5 class="text-center no-margin">Customer Information</h5>
                    </th>
                </tr>
                <tr>
                    <th>Name</th>
                    <td class="text-muted">{{$table->customer['name']}}</td>
                </tr>
                <tr>
                    <th>Contact</th>
                    <td class="text-violet">{{$table->customer['contactNo']}}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td class="text-muted">{{$table->customer['email']}}</td>
                </tr>
                <tr>
                    <th>Address</th>
                    <td class="text-muted">{{$table->customer['address']}}</td>
                </tr>
                <tr>
                    <th>Roll</th>
                    <td class="text-purple">{{$table->customer['userType']}}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
<!-- title row -->
<div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-globe"></i> {{config('sp.company')}}.com
            <small class="pull-right">Date: {{pub_date($table->created_at)}}</small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          From
          <address>
            <strong>{{config('sp.company')}}</strong><br>
            {{config('sp.address')}}<br>
            {{config('sp.city')}}<br>
            Phone: {{config('sp.contact')}}<br>
            Email: {{config('sp.email')}}
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          To
          <address>
            <strong>{{$table->customer['name']}}</strong><br>
            {{$table->customer['address']}}<br>
            Phone: {{$table->customer['contactNo']}}<br>
            Email: {{$table->customer['email']}}
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          <b>Invoice #{{invoice_n($table->orderID)}}</b><br>
          <br>
          <b>Order ID:</b> {{invoice_n($table->orderID)}}<br>
          <b>Order Date:</b> {{pub_date($table->created_at)}}<br>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped">
            <thead>
            <tr>
              <th>#</th>
              <th>Product</th>
              <th>Price</th>
              <th>Qty</th>
              <th class="text-right">Subtotal</th>
            </tr>
            </thead>
            <tbody>
                    @php
                    $i = 1;
                    $total = 0;
                    $order_item = $table->order_item()->get();
                @endphp
            @foreach($order_item as $row)
            <tr>
              <td>{{$i++}}</td>
              <td>{{$row->product['name']}}</td>
              <td>{{money($row->price)}}</td>
              <td>{{$row->quantity}}</td>
              <td class="text-right">{{money($row->quantity * $row->price)}}</td>
            </tr>
            @php
            $total += ($row->quantity * $row->price);
            $i++;
        @endphp
            @endforeach
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">
        <!-- accepted payments column -->
        <div class="col-xs-6">
          <p class="lead">Customers Note:</p>

          <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
            {{$table->description}}
          </p>
        </div>
        <!-- /.col -->
        <div class="col-xs-6">
          <div class="table-responsive">
            <table class="table">
              <tr>
                <th style="width:50%">Subtotal:</th>
                <td>{{money($total)}}</td>
              </tr>
              <tr>
                <th>Shipping:</th>
                <td>{{money(config('sp.dCharge'))}}</td>
              </tr>
              <tr>
                <th>Total:</th>
                <td>{{money($total + $table->deliveryCharge + config('sp.dCharge'))}}</td>
              </tr>
              <tr>
                    <td colspan="2" class="text-center text-brown"><p class="no-margin">[ <strong>In word:</strong> {{ucwords(in_word($total + $table->deliveryCharge))}} ]</p></td>
                </tr>
            </table>
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
@endsection
