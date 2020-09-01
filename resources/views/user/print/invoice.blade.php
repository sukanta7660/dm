@extends('layouts.master')
@section('title')
Invoice
@endsection
@section('style')
<link rel="stylesheet" href="{{asset('public/user_asset/invoice.css')}}">
@endsection
@section('content')
<div class="container-fluid mt-5">
    <div id="ui-view" data-select2-id="ui-view">
        <div>
            <div class="card">
                <div class="card-header">Invoice
                    <strong>#{{invoice_n($table->orderID)}}</strong>
                    <a title="Print" style="border-radius: 0;padding: 1px 18px;" class="btn btn-sm btn-success border-0 float-right mr-1 d-print-none" href="#" onclick="javascript:window.print();" data-abc="true">
                            <i class="icon-print"></i></a>
                    <a style="border-radius: 0;padding: 0px 18px;" class="btn btn-sm btn-info float-right mr-1 d-print-none" onclick="history.go(-1)" href="#" data-abc="true">
                        <i class="icon-download"></i></a>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-sm-4">
                            <h6 class="mb-3">From:</h6>
                            <div>
                                <strong>{{config('sp.company')}}</strong>
                            </div>
                            <div>{{config('sp.address')}}</div>
                            <div>{{config('sp.city')}}</div>
                            <div>Email: {{config('sp.email')}}</div>
                            <div>Phone: {{config('sp.contact')}}</div>
                        </div>
                        <div class="col-sm-4">
                            <h6 class="mb-3">To:</h6>
                            <div>
                                <strong>{{$table->customer['name']}}</strong>
                            </div>
                            <div>{{$table->customer['address']}}</div>
                            <div>Email: {{$table->customer['email']}}</div>
                            <div>Phone: {{$table->customer['contactNo']}}</div>
                        </div>
                        <div class="col-sm-4">
                            <h6 class="mb-3">Details:</h6>
                            <div>Invoice
                                <strong>#{{invoice_n($table->orderID)}}</strong>
                            </div>
                            <div>{{pub_date_month($table->created_at)}}</div>
                        </div>
                    </div>
                    <div class="table-responsive-sm">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="center">#</th>
                                    <th>Item</th>
                                    <th class="center">Quantity</th>
                                    <th class="right">Qty</th>
                                    <th class="right">Total</th>
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
                                    <td class="center">{{$i++}}</td>
                                    <td class="left">{{$row->product['name']}}</td>
                                    <td class="center">{{money($row->price)}}</td>
                                    <td class="right">{{$row->quantity}}</td>
                                    <td class="right">{{money($row->quantity * $row->price)}}</td>
                                </tr>
                                @php
                                    $total += ($row->quantity * $row->price);
                                    $i++;
                                @endphp
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-sm-5">
                            <p class="no-margin">[ <strong>In word:</strong> {{ucwords(in_word($total + $table->deliveryCharge))}} ]</p>
                        </div>
                        <div class="col-lg-4 col-sm-5 ml-auto">
                            <table class="table table-clear">
                                <tbody>
                                    <tr>
                                        <td class="text-left">
                                            <strong>Subtotal</strong>
                                        </td>
                                        <td class="right">{{money($total)}}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-left">
                                            <strong>Delivery Charge</strong>
                                        </td>
                                        <td class="right">{{money(config('sp.dCharge'))}}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-left">
                                            <strong>Total</strong>
                                        </td>
                                        <td class="right">
                                            <strong>{{money($total + $table->deliveryCharge + config('sp.dCharge'))}}</strong>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
