@extends('layouts.admin_master')
@section('title')
    New Appointment
@endsection
@section('content')
    <div class="row">
        <div class="col-md-4 btn_mod">
            @if(session()->has('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-xs-10">
            <div class="box">
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="dataTable" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Patient Name</th>
                            <th>Age</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Doctor</th>
                            <th class="text-right">Action</th>
                        </tr>
                        </thead>
                        <tbody
                        @php
                            $i = 1;
                        @endphp
                        @foreach($table as $row)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$row->name}}</td>
                                <td>{{$row->patient_Age}} years old</td>
                                <td>{{$row->number}}</td>
                                <td>{{$row->address}}</td>
                                <td>{{$row->doctor['name']}}</td>
                                <td class="text-right">
                                    <a title="check" href="{{action('Admin\AppointmentController@check',['id' => $row->id])}}" onclick="return confirm('Are you sure to check?')" class="btn btn-xs btn-flat btn-success"><i class="fa fa-check"></i></a>
                                    <a title="delete" href="{{action('Admin\AppointmentController@del',['id' => $row->id])}}" onclick="return confirm('Are you sure to delete?')" class="btn btn-xs btn-flat btn-danger"><i class="fa fa-close"></i></a>
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