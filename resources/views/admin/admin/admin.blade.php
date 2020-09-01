@extends('layouts.admin_master')
@section('title')
    All Admin
@endsection
@section('content')
    <div class="row">
        <div class="col-md-4">
            @if(session()->has('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">All Admin</h3>
                </div>
                <div class="box-body">
                    <table id="dataTable" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th class="">S/N</th>
                            <th class="">Image</th>
                            <th class="">Name</th>
                            <th class="">MObile</th>
                            <th class="">User Role</th>
                            <th class="text-right">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($table as $row)
                            <tr>
                                <td class="">#000{{$row->id}}</td>
                                <td class="">{{$row->name}}</td>
                                <td class="">{{$row->name}}</td>
                                <td class="">
                                    @if($row->contactNo == null)
                                    N/A
                                    @else
                                    {{$row->contactNo}}
                                    @endif
                                </td>
                                <td class="">{{$row->userType}}</td>
                                <td class="text-right">
                                    <button title="change user type" data-id="{{$row->id}}" data-usertype="{{$row->userType}}" class="btn btn-xs btn-flat btn-info ediBtn"  data-toggle="modal" data-target="#ediStatusModal">User Type</button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="ediStatusModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Update User Roll.</h4>
                </div>
            <form id="ediForm" action="{{action('Admin\Customer\CustomerController@make')}}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <input type="hidden" name="id">
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    Status
                                </div>
                                <select class="form-control pull-right" name="userType">
                                    <option value="Admin">Admin</option>
                                    <option value="Customer">Customer</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $(function () {
            $('.ediBtn').click(function () {
                var id = $(this).data('id');
                var usertype = $(this).data('usertype');


                $('#ediForm [name=id]').val(id);
                $('#ediForm [name=userType]').val(usertype);

            });
        });
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
