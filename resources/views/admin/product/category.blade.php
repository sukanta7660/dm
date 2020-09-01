@extends('layouts.admin_master')
@extends('box.admin.product.category')
@section('title')
    Product Category
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
                Add a Product Category
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
                        <tbody>
                        @foreach($table as $row)
                            <tr>
                                <td>{{$row->categoryID}}</td>
                                <td>{{$row->name}}</td>
                                <td class="text-right">
                                    <button title="edit" data-id="{{$row->categoryID}}" data-name="{{$row->name}}" class="btn btn-xs btn-flat btn-info ediModal"  data-toggle="modal" data-target="#ediModal">Edit</button>
                                    <a title="delete" href="{{action('Admin\Product\CategoryController@del',['id' => $row->categoryID])}}" onclick="return confirm('Are you sure to delete?')" class="btn btn-xs btn-flat btn-danger"><i class="fa fa-close"></i></a>
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

                $('#ediForm [name=id]').val(id);
                $('#ediForm [name=name]').val(name);

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