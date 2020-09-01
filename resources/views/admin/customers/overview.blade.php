@extends('layouts.general')
@section('title')
{{$table->name}}'s  Overview
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
                            <h5 class="text-center no-margin">Customer Information</h5>
                        </th>
                    </tr>
                    <tr>
                        <th>Name</th>
                        <td class="text-muted">{{$table->name}}</td>
                    </tr>
                    <tr>
                        <th>Mobile</th>
                        <td class="text-violet">{{$table->contactNo}}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td class="text-muted">{{$table->email}}</td>
                    </tr>
                    <tr>
                        <th>Address</th>
                        <td class="text-muted">{{$table->address}}</td>
                    </tr>

                </tbody>
            </table>
        </div>
        <div class="col-md-6">
            <table class="table table-bordered table-striped table-condensed table-hover">
                <tbody>
                <tr>
                    <th colspan="2">
                        <h5 class="text-center no-margin">Overview</h5>
                    </th>
                </tr>
                <tr>
                    <th>Total Order</th>
                    <td class="text-muted">{{$table->orders()->count()}}</td>
                </tr>
                <tr>
                    <th>Total Amount</th>
                    <td class="text-violet">{{money($table->orders()->sum('paidAmount'))}}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
<!-- title row -->

      <div class="row">
        <div class="col-xs-12">
            <div class="box">
                    <div class="box-header">
                            <h6 class="box-title"><span class="text-primary">{{$table->name}}'s</span> Orders</h6>
                    </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="dataTable" class="table table-bordered table-striped">
                            <thead>
                                    <tr>
                                        <th>OrderDate</th>
                                        <th>#Order</th>
                                        <th>Phone</th>
                                        <th>Order Status</th>
                                        <th class="text-right">Amount</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($orders as $row)
                                        <tr>
                                            <td>{{pub_date($row->deliveryDate)}}</td>
                                            <td>#{{invoice_n($row->orderID)}}</td>
                                            <td>{{$row->contactNo}}</td>
                                            @php
                                                $total = 0;
                                                $item = $row->order_item()->select('quantity', 'price')->where('quantity', '>', 0)->get();
                                                foreach ($item as $val){
                                                    $total += ($val->quantity * $val->price);
                                                }
                                            @endphp
                                            <td class="{{ $row->orderStatus == 'Pending' ? 'text-danger' : 'text-success' }}">{{$row->orderStatus}}</td>
                                            <td class="text-right">{{money($total)}}</td>
                                            <td class="text-right">
                                                <div class="white_sp">
                                                    <a class="btn btn-xs btn-flat btn-success" href="{{action('Admin\Orders\OrderInvoiceController@invoice',['id' => $row->orderID])}}" title="invoice"><i class="fa fa-eye"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $(function () {
            $('#dataTable').DataTable({
                "order": [[ 0, "ASC" ]],
                "iDisplayLength": 25,
                "columnDefs": [
                    { "orderable": false, "targets": [5]}
                ]
            });
        });
    </script>
@endsection
