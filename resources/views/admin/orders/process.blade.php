@extends('layouts.admin_master')
@section('title')
    Processing Orders
@endsection
@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                    <div class="box-header">
                            <h6 class="box-title">Processing Orders</h6>
                    </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="dataTable" class="table table-bordered table-striped">
                            <thead>
                                    <tr>
                                        <th>OrderDate</th>
                                        <th>Remaining</th>
                                        <th>#Order</th>
                                        <th>Customer</th>
                                        <th>Phone</th>
                                        <th>Amount</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($table as $row)
                                        <tr>
                                            <td>{{pub_date_month($row->deliveryDate)}} <small class="text-muted">{{pub_time($row->deliveryDate)}}</small></td>
                                            <td class="{{(ends_with(remain_time($row->deliveryDate), 'before')? 'text-danger':'')}}">{{remain_time($row->deliveryDate)}}</td>
                                            <td>#{{invoice_n($row->orderID)}}</td>
                                            <td>{{$row->customer['name']}}</td>
                                            <td>{{$row->contactNo}}</td>
                                            @php
                                                $total = 0;
                                                $item = $row->order_item()->select('quantity', 'price')->where('quantity', '>', 0)->get();
                                                foreach ($item as $val){
                                                    $total += ($val->quantity * $val->price);
                                                }
                                            @endphp
                                            <td>{{money($total)}}</td>
                                            <td class="text-right">
                                                <div class="white_sp">
                                                    <a class="btn btn-xs btn-default btn-flat mr-5" onclick="return confirm('want to send it to complete state? ')" href="{{action('Admin\Orders\PendingController@complete_order',['id' => $row->orderID])}}" title="complete"><i class="fa fa-check"></i></a>
                                                <a class="btn btn-xs btn-info btn-flat mr-5" href="{{action('Admin\Orders\OrderInvoiceController@index',['id' => $row->orderID])}}" title="Preview"><i class="fa fa-eye"></i></a>
                                                    <a class="btn btn-xs btn-success btn-flat" href="{{action('Admin\Orders\OrderInvoiceController@invoice',['id' => $row->orderID])}}" title="invoice"><i class="fa fa-arrow-right"></i></a>
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
                    { "orderable": false, "targets": [6]}
                ]
            });
        });
    </script>
@endsection
