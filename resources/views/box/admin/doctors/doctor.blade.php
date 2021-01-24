@section('box')

    <div id="myModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h5 class="modal-title"><i class="fa fa-plus"></i> &nbsp;Add a Doctor </h5>
                </div>
                <form action="{{action('Admin\DoctorController@store')}}" method="post" enctype="multipart/form-data" autocomplete="off">
                    {!! csrf_field() !!}
                    <div class="modal-body">
                        <div class="input-group">
                            <span class="input-group-addon">Name</span>
                            <input name="name" class="form-control" placeholder="Name" type="text" required>
                        </div><br>
                        <div class="input-group">
                            <span class="input-group-addon">Department</span>
                            <select name="department_id" id="" class="form-control">
                                <option value="">Select a Department</option>
                                @foreach ($depts as $item)
                                    <option value="{{$item->id}}">{{$item->dept_Name}}</option>
                                @endforeach
                                
                            </select>
                        </div><br>
                        <div class="input-group">
                            <span class="input-group-addon">Degree</span>
                            <input type="text"  class="form-control" placeholder="Enter Degrees" name="degrees">
                        </div><br>
                        <div class="input-group">
                            <span class="input-group-addon">Check Fee</span>
                            <input type="number"  class="form-control" placeholder="Enter Check fee" name="checkFee" >
                        </div><br>
                        <div class="input-group">
                            <span class="input-group-addon">Chamber Details</span>
                            <input type="text"  class="form-control" placeholder="Enter Chamber details" name="chamberDetails" >
                        </div><br>
                        <div class="input-group">
                            <span class="input-group-addon">Mobile No</span>
                            <input type="text"  class="form-control" placeholder="Enter mobile no" name="mobileNo" >
                        </div><br>
                        <div class="input-group">
                            <span class="input-group-addon">Time</span>
                            <input type="text"  class="form-control" placeholder="Enter time" name="time">
                        </div><br>
                        <div class="input-group">
                            <span class="input-group-addon">Description</span>
                            <textarea class="form-control" name="description"  cols="50" rows="5" placeholder="Description here"></textarea>
                        </div><br>
                        <div class="input-group">
                            <span class="input-group-addon">Specialist</span>
                            <textarea class="form-control" name="description"  cols="50" rows="5" placeholder="Description here"></textarea>
                        </div><br>
                        <div class="input-group">
                            <span class="input-group-addon">Image</span>
                            <input type="file" onchange="document.getElementById('doctor_image').src = window.URL.createObjectURL(this.files[0])" class="form-control" name="imageName">
                        </div><br>
                        <div class="input-group">
                            <img id="doctor_image" width="200" height="100">
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
                    <h5 class="modal-title"><i class="fa fa-edit"></i> &nbsp;Edit Department</h5>
                </div>
                <form id="ediForm" action="{{action('Admin\DoctorController@edit')}}" method="post" enctype="multipart/form-data" autocomplete="off">
                    {!! csrf_field() !!}
                    <input type="hidden" name="id">
                    <div class="modal-body">
                        <div class="input-group">
                            <span class="input-group-addon">Name</span>
                            <input name="name" class="form-control" placeholder="Name" type="text" required>
                        </div><br>
                        <div class="input-group">
                            <span class="input-group-addon">Department</span>
                            <select name="department_id" id="" class="form-control">
                                <option value="">Select a Department</option>
                                @foreach ($depts as $item)
                                    <option value="{{$item->id}}">{{$item->dept_Name}}</option>
                                @endforeach
                                
                            </select>
                        </div><br>
                        <div class="input-group">
                            <span class="input-group-addon">Degree</span>
                            <input type="text"  class="form-control" placeholder="Enter Degrees" name="degrees">
                        </div><br>
                        <div class="input-group">
                            <span class="input-group-addon">Check Fee</span>
                            <input type="number"  class="form-control" placeholder="Enter Check fee" name="checkFee" >
                        </div><br>
                        <div class="input-group">
                            <span class="input-group-addon">Chamber Details</span>
                            <input type="text"  class="form-control" placeholder="Enter Chamber details" name="chamberDetails" >
                        </div><br>
                        <div class="input-group">
                            <span class="input-group-addon">Mobile No</span>
                            <input type="text"  class="form-control" placeholder="Enter mobile no" name="mobileNo" >
                        </div><br>
                        <div class="input-group">
                            <span class="input-group-addon">Time</span>
                            <input type="text"  class="form-control" placeholder="Enter time" name="time">
                        </div><br>
                        <div class="input-group">
                            <span class="input-group-addon">Description</span>
                            <textarea class="form-control" name="description"  cols="50" rows="5" placeholder="Description here"></textarea>
                        </div><br>
                        <div class="input-group">
                            <span class="input-group-addon">Specialist</span>
                            <textarea class="form-control" name="description"  cols="50" rows="5" placeholder="Description here"></textarea>
                        </div><br>
                        <div class="input-group">
                            <span class="input-group-addon">Image</span>
                            <input type="file" onchange="document.getElementById('doctor_image').src = window.URL.createObjectURL(this.files[0])" class="form-control" name="imageName">
                        </div><br>
                        <div class="input-group">
                            <img id="doctor_image" width="200" height="100">
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