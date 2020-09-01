@extends('layouts.general')
@section('title')
Invoice No- #{{invoice_n($table->orderID)}}
@endsection

@section('back-url')
    <div class="col-xs-12 no-print">
        <button style="margin-left: -80px;" type="button" class="btn btn-danger btn-md heading-btn print-hide" onclick="history.go(-1)"><i class="fa fa-arrow-left position-left"></i> Go Back</button>
        <button style="margin-right: -80px;" type="button" class="btn btn-success pull-right btn-md heading-btn print-hide" onclick="window.print()"><i class="fa fa-print position-left"></i> Print</button>
    </div>
@endsection
@section('content')
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
        <div class="col-xs-8">

        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <div class="table-responsive">
            <table class="table">
              <tr>
                <th style="width:50%">Subtotal:</th>
                <td class="text-right">{{money($total)}}</td>
              </tr>
              <tr>
                <th>Shipping:</th>
                <td class="text-right">{{money(config('sp.dCharge'))}}</td>
              </tr>
              <tr>
                <th>Total:</th>
                <td class="text-right">{{money($total + $table->deliveryCharge + config('sp.dCharge'))}}</td>
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
