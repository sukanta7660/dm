@extends('layouts.admin_master')
@extends('box.admin.doctors.doctor')
@section('title')
    Doctors
@endsection
@section('content')
    <div class="row">
        <div class="col-md-4 btn_mod">
            @if(session()->has('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 btn_mod">
            <button class="btn btn-social btn-primary btn-xs btn-flat" data-toggle="modal" data-target="#myModal">
                <i class="fa fa-plus"></i>
                Add a Doctor
            </button>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-8">
            <div class="box">
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="dataTable" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Name</th>
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
                                <td class="text-right">
                                    <button title="edit" data-id="{{$row->id}}" data-dept="{{$row->department_id}}" data-name="{{$row->name}}" data-degrees="{{$row->degrees}}" data-checkfee="{{$row->checkFee}}" data-chamber="{{$row->chamberDetails}}" data-mobile="{{$row->mobileNo}}" data-time="{{$row->time}}" data-des="{{$row->description}}" data-specialist="{{$row->specialist}}" class="btn btn-xs btn-flat btn-info ediModal"  data-toggle="modal" data-target="#ediModal">Edit</button>
                                    <a title="delete" href="{{action('Admin\DoctorController@del',['id' => $row->id])}}" onclick="return confirm('Are you sure to delete?')" class="btn btn-xs btn-flat btn-danger"><i class="fa fa-close"></i></a>
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
            $('.ediModal').click(function () {
                var id = $(this).data('id');
                var name = $(this).data('name');
                var degrees = $(this).data('degrees');
                var checkfee = $(this).data('checkfee');
                var chamber = $(this).data('chamber');
                var mobile = $(this).data('mobile');
                var des = $(this).data('des');
                var specialist = $(this).data('specialist')
                var dept = $(this).data('dept');
                var time = $(this).data('time');

                $('#ediForm [name=id]').val(id);
                $('#ediForm [name=name]').val(name);
                $('#ediForm [name=department_id]').val(dept);
                $('#ediForm [name=chamberDetails]').val(chamber);
                $('#ediForm [name=mobileNo]').val(mobile);
                $('#ediForm [name=degrees]').val(degrees);
                $('#ediForm [name=description]').val(des);
                $('#ediForm [name=checkFee]').val(checkfee);
                $('#ediForm [name=time]').val(time);
                $('#ediForm [name=specialist]').val(specialist);

            });
        });
        $(function () {
            $('#dataTable').DataTable({
                "order": [[ 0, "ASC" ]],
                "iDisplayLength": 25,
                "columnDefs": [
                    { "orderable": false, "targets": [2]}
                ]
            });
        });
    </script>
@endsection