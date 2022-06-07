@if (count($users))  
    <table class="table table-striped table-hover m-b-0">
        <thead>
            <tr>
                <th width="60"><span>№</span></th>
                <th><span>Name</span></th>
                <th width="250"><span>Department</span></th>
                <th width="200"><span>Phone</span></th>
                <th width="120"><span>Date</span></th>
                <th width="120"><span>Status</span></th>
                <th class="text-center" width="250"><span>Action</span></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $item)
                <tr>
                <td>{{$loop->index+1}}</td>
                <td>{{$item->fullname}}</td>
                <td>{{$item->department}}</td>
                <td>{{$item->phone}}</td>
                <td>{{$item->date_vacation->format('d-m-Y')}}</td>
                <td>
                    @if ($item->date_vacation > now())
                    @if ($item->date_vacation->diffInDays() + 1 > 5)
                        <span class="badge badge-primary"> {{$item->date_vacation->diffInDays() + 1}} days left</span>
                    @else
                        <span class="badge badge-warning"> {{$item->date_vacation->diffInDays() + 1}} days left</span>
                    @endif
                    @else
                        <span class="badge badge-danger">Expired<span class="ms-1 fas fa-ban" data-fa-transform="shrink-2"></span></span>
                    @endif
                </td>
                <td>
                    <button type="button" class="btn btn-icon btn-outline-success" title="Success" data-toggle="modal" data-target="#succmodal{{$item->id}}"><i class="fa fa-check"></i></button>
                    <button type="button" class="btn btn-icon btn-outline-secondary" title="Edit" data-toggle="modal" data-target="#editmodal{{$item->id}}"><i class="fa fa-edit"></i></button>
                    <button type="button" class="btn btn-icon btn-outline-danger" title="Delete" data-toggle="modal" data-target="#deletemodal{{$item->id}}"><i class="fa fa-trash-alt"></i></button>
                    <button type="button" class="btn  btn-icon btn-outline-primary" title="Send Sms" data-toggle="modal" data-target="#sendmodal{{$item->id}}"><i class="fa fa-paper-plane"></i></button>
                </td>
                </tr>
                
                <div id="succmodal{{$item->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <form action="{{route('success_user')}}" method="get">
                    @csrf
                    <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Success User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                            <input type="hidden" name="iduser" value="{{$item->id}}">
                            <input type="text" class="form-control" value="{{$item->fullname}}" readonly style="width: 100%;" required>
                            </div>   
                            <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="customswitch1" onclick="myFunction()">
                                <label class="custom-control-label" for="customswitch1">Update Date</label>
                            </div>
                            </div> 
                            <div class="form-group">
                            <label for="organization_phone"> Date</label>
                            <input type="date" class="form-control" readonly="true" id="date_vacation" name="date_vacation"  value="{{$item->date_vacation->addYear()->format('Y-m-d')}}" required style="width: 100%;">
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
                
                <div id="editmodal{{$item->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <form action="{{route('edit_user')}}" method="get">
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
                            <label for="edtname">Fullname</label>
                            <input type="text" class="form-control" id="editname" name="nameedit" value="{{$item->fullname}}" style="width: 100%;" required>
                            </div>   
                            <div class="form-group">
                            <label for="departmentedit">Department</label>
                                <input type="text" class="form-control" id="departmentedit" value="{{$item->department}}" name="departmentedit" style="width: 100%;" required>
                            </div> 
                            <div class="form-group">
                            <label for="organization_phone"> Phone Number</label>
                            <input type="text" id="phone2" class="form-control" name="phone2"  required value="{{$item->phone}}" style="width: 100%;">
                            </div>

                            <div class="form-group">
                            <label for="organization_phone"> Date</label>
                            <input type="date" class="form-control" name="date_vac"  value="{{$item->date_vacation->format('Y-m-d')}}" required style="width: 100%;">
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
                <form action="{{route('delete_user')}}" method="get">
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

                <div id="sendmodal{{$item->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <form action="{{route('send_message')}}" method="get">
                    @csrf
                    <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Send Message</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                            <input type="hidden" name="idusersend" value="{{$item->id}}">
                            <input type="hidden" name="phonesenduser" value="{{$item->phone}}">
                            <h5><code> to:</code> {{$item->fullname}}</h5>
                            </div>   
                            <div class="form-group">
                            <label for="textmessage">Text Message</label>
                                <textarea name="textmessage" class="form-control" id="textmessage" style="width: 100%" required></textarea>
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

            @endforeach
        </tbody>
    </table>
@endif