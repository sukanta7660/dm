@section('box')

    <div id="myModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h5 class="modal-title"><i class="fa fa-plus"></i> &nbsp;Add a Product </h5>
                </div>
                <form action="{{action('Admin\Product\ProductController@save')}}" method="post" enctype="multipart/form-data" autocomplete="off">
                    {!! csrf_field() !!}
                    <div class="modal-body">
                        <div style="margin-bottom: 14px;" class="input-group">
                            <span class="input-group-addon">Category</span>
                            <select name="categoryID" class="form-control">
                                <option value="">Select a Category</option>
                                @foreach($category as $row)
                                    <option value="{{$row->categoryID}}">{{$row->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div style="margin-bottom: 14px;" class="input-group">
                            <span class="input-group-addon">Type</span>
                            <select name="productType" class="form-control">
                                <option value="">Select a Type</option>
                                <option value="Tablet">Tablet</option>
                                <option value="Syrup">Syrup</option>
                                <option value="Insulin">Insulin</option>
                            </select>
                        </div>
                        <div style="margin-bottom: 14px;" class="input-group">
                            <span class="input-group-addon">Name</span>
                            <input name="name" class="form-control" placeholder="Product Name" value="{{old('name')}}" type="text">
                        </div>
                        <div style="margin-bottom: 14px;" class="input-group">
                            <span class="input-group-addon">Group</span>
                            <input name="productGroup" class="form-control" placeholder="Product Group" value="{{old('productGroup')}}" type="text">
                        </div>
                        <div style="margin-bottom: 14px;" class="input-group">
                            <span class="input-group-addon">Price</span>
                            <input name="price" class="form-control" value="0" placeholder="Food price" step="any" type="number">
                        </div>
                        <div style="margin-bottom: 14px;" class="input-group">
                            <span class="input-group-addon">Specification</span>
                            <textarea name="specification" class="form-control" cols="3" rows="2" placeholder="specification">{{old('specification')}}</textarea>
                        </div>
                        <div style="margin-bottom: 14px;" class="input-group">
                            <span class="input-group-addon">Description</span>
                            <textarea name="description" class="form-control" cols="3" rows="2" placeholder="Description">{{old('description')}}</textarea>
                        </div>
                        <div class="input-group">
                            <span class="input-group-addon">Image</span>
                            <input onchange="document.getElementById('foodImage').src = window.URL.createObjectURL(this.files[0])" style="padding: 0;" name="imageName" class="form-control" type="file">
                        </div>
                        <div style="margin-top: 14px" class="input-group">
                            <img id="foodImage" style="height: 200px; width: 100%; margin-top: 10px" alt="image">
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn-flat">Save</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>

    <div id="ediModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h5 class="modal-title"><i class="fa fa-edit"></i> &nbsp;Edit Product</h5>
                </div>
                <form id="ediForm" action="{{action('Admin\Product\ProductController@edit')}}" method="post" enctype="multipart/form-data" autocomplete="off">
                    {!! csrf_field() !!}
                    <input type="hidden" name="id">
                    <div class="modal-body">
                        <div style="margin-bottom: 14px;" class="input-group">
                            <span class="input-group-addon">Category</span>
                            <select name="categoryID" class="form-control">
                                <option value="">Select a Category</option>
                                @foreach($category as $row)
                                    <option value="{{$row->categoryID}}">{{$row->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div style="margin-bottom: 14px;" class="input-group">
                            <span class="input-group-addon">Type</span>
                            <select name="productType" class="form-control">
                                <option value="">Select a Type</option>
                                <option value="Tablet">Tablet</option>
                                <option value="Syrup">Syrup</option>
                                <option value="Insulin">Insulin</option>
                            </select>
                        </div>
                        <div style="margin-bottom: 14px;" class="input-group">
                            <span class="input-group-addon">Name</span>
                            <input name="name" class="form-control" placeholder="Food Name" type="text">
                        </div>
                        <div style="margin-bottom: 14px;" class="input-group">
                            <span class="input-group-addon">Group</span>
                            <input name="productGroup" class="form-control" placeholder="Product Group" value="{{old('productGroup')}}" type="text">
                        </div>
                        <div style="margin-bottom: 14px;" class="input-group">
                            <span class="input-group-addon">Price</span>
                            <input name="price" class="form-control" placeholder="Food price" step="any" type="number">
                        </div>
                        <div style="margin-bottom: 14px;" class="input-group">
                            <span class="input-group-addon">Specification</span>
                            <textarea name="specification" class="form-control" cols="3" rows="2" placeholder="specification"></textarea>
                        </div>
                        <div style="margin-bottom: 14px;" class="input-group">
                            <span class="input-group-addon">Description</span>
                            <textarea name="description" class="form-control" cols="3" rows="2" placeholder="Description"></textarea>
                        </div>
                        <div class="input-group">
                            <span class="input-group-addon">Image</span>
                            <input onchange="document.getElementById('productImage1').src = window.URL.createObjectURL(this.files[0])" style="padding: 0;" name="imageName" class="form-control" type="file">
                        </div>
                        <div style="margin-top: 14px" class="input-group">
                            <img id="productImage1" style="height: 200px; width: 100%; margin-top: 10px" alt="image">
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn-flat">Save changes</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
@endsection
