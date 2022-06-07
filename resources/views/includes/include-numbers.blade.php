@if (count($numbers))  
    <table class="table table-striped table-hover m-b-0">
        <thead>
            <tr>
                <th width="60"><span>№</span></th>
                <th><span>Name</span></th>
                <th width="250"><span>Department</span></th>
                <th width="200"><span>Phone</span></th>
                <th class="text-center" width="150"><span>Action</span></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($numbers as $item)
                <tr>
                <td>{{$loop->index+1}}</td>
                <td>{{$item->fullname}}</td>
                <td>{{$item->department}}</td>
                <td>{{$item->numbers}}</td>
                <td>
                    <button type="button" class="btn btn-icon btn-outline-secondary" title="Edit" data-toggle="modal" data-target="#editmodal{{$item->id}}"><i class="fa fa-edit"></i></button>
                    <button type="button" class="btn btn-icon btn-outline-danger" title="Delete" data-toggle="modal" data-target="#deletemodal{{$item->id}}"><i class="fa fa-trash-alt"></i></button>
                </td>
                </tr>
                
                
                <div id="editmodal{{$item->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <form action="{{route('edit_number')}}" method="get">
                    @csrf
                    <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Edit User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                            <input type="hidden" name="iduseredit" value="{{$item->id}}">
                            <label for="edtname">Name Relay</label>
                            <input type="text" class="form-control" id="editname" name="nameedit" value="{{$item->fullname}}" style="width: 100%;" required>
                            </div>   
                            <div class="form-group">
                            <label for="departmentedit">Department</label>
                                <input type="text" class="form-control" id="departmentedit" value="{{$item->department}}" name="departmentedit" style="width: 100%;" required>
                            </div> 
                            <div class="form-group">
                            <label for="organization_phone"> Phone Number</label>
                            <input type="text" id="phone2" class="form-control" name="phone2"  required value="{{$item->numbers}}" style="width: 100%;">
                            </div>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn  btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn  btn-success">Submit </button>
                        </div>
                    </div>
                    </div>
                </form>
                </div>

                <div id="deletemodal{{$item->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <form action="{{route('delete_number')}}" method="get">
                    @csrf
                    <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Delete User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                            <input type="hidden" name="iduserdelete" value="{{$item->id}}">
                            <h4><code> {{$item->fullname}} </code></h4>
                            </div>   
                            <div class="form-group">
                            <h4>
                                Do you really want to delete?
                            </h4>
                            </div>  
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn  btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn  btn-danger">Delete </button>
                        </div>
                    </div>
                    </div>
                </form>
                </div>

             

            @endforeach
        </tbody>
    </table>
@endif