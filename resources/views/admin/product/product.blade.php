@extends('layouts.admin_master')
@extends('box.admin.product.product')
@section('title')
    Products
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
                Add Product
            </button>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="dataTable" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th class="text-right">Price</th>
                            <th class="text-right">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($table as $row)
                            <tr>
                                <td>{{$row->productID}}</td>
                                <td>
                                    <img src="{{ck_file('products', 'public/uploads/products', 'sm_'.$row->imageName, 'sm')}}" height="20" width="40">
                                </td>
                                <td>{{$row->name}}</td>
                                <td>{{$row->category['name']}}</td>
                                <td class="text-right">{{money($row->price)}}</td>
                                <td class="text-right">
                                    <button title="edit" data-id="{{$row->productID}}" data-grp="{{$row->productGroup}}" data-typ="{{$row->productType}}" data-specifictn="{{$row->specification}}" data-name="{{$row->name}}" data-price="{{$row->price}}" data-des="{{$row->description}}" data-category="{{$row->categoryID}}" data-img="{{asset('public/uploads/products/'.$row->imageName)}}" class="btn btn-xs btn-flat btn-info ediModal"  data-toggle="modal" data-target="#ediModal">Edit</button>

                                    <a title="delete" href="{{action('Admin\Product\ProductController@del',['id' => $row->productID])}}" onclick="return confirm('Are you sure to delete?')" class="btn btn-xs btn-flat btn-danger"><i class="fa fa-close"></i></a>
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
                var price = $(this).data('price');
                var des = $(this).data('des');
                var grp = $(this).data('grp');
                var typ = $(this).data('typ');
                var specifictn = $(this).data('specifictn');
                var category = $(this).data('category');
                var img = $(this).data('img');

                $('#ediForm [name=id]').val(id);
                $('#ediForm [name=name]').val(name);
                $('#ediForm [name=price]').val(price);
                $('#ediForm [name=productType]').val(typ);
                $('#ediForm [name=productGroup]').val(grp);
                $('#ediForm [name=description]').val(des);
                $('#ediForm [name=specification]').val(specifictn);
                $('#ediForm [name=categoryID]').val(category);
                $("#productImage1").attr("src", img);

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
