@extends('layouts.master')

@section('content')

    @if (\Session::has('msg'))
        @if (Session::get('msg') == 1)
            <div class="alert alert-success" id="success-alert">Succesfully!</div>
        @else
            <div class="alert alert-danger" id="success-alert2">Not Success!</div>
        @endif
    @endif

    <div class="col">
        <div class="card table-card">
            <div class="card-header">

                <div class="form-inline">
                    <div class="form-group mx-sm-3 mb-2">
                        <form action="{{ route('home') }}" method="get">
                            @csrf
                            <input class="form-control form-control-sm" value="{{ request()->query('search') }}"
                                name="search" type="search" placeholder="search ..." />
                        </form>
                    </div>
                    <button type="button" class="btn btn-primary mb-2 btn-sm" data-toggle="modal"
                        data-target="#exampleModalCenter"><i class="fa fa-plus mr-2"></i>Add Worker</button>
                </div>

                <div class="card-header-right">
                    <div class="btn-group card-option">
                        <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <i class="feather icon-more-horizontal"></i>
                        </button>
                        <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right">
                            <li class="dropdown-item full-card"><a href="#!"><span><i class="feather icon-maximize"></i>
                                        maximize</span><span style="display:none"><i class="feather icon-minimize"></i>
                                        Restore</span></a></li>
                            <li class="dropdown-item minimize-card"><a href="#!"><span><i class="feather icon-minus"></i>
                                        collapse</span><span style="display:none"><i class="feather icon-plus"></i>
                                        expand</span></a></li>
                            <li class="dropdown-item reload-card"><a href="#!"><i class="feather icon-refresh-cw"></i>
                                    reload</a></li>
                            <li class="dropdown-item close-card"><a href="#!"><i class="feather icon-file-text"></i>
                                    Export</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div id="exampleModalCenter" class="modal fade" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <form action="{{ route('add_worker') }}" method="post">
                    @csrf
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalCenterTitle">Add Worker</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="fullname" placeholder="Fullname"
                                        style="width: 100%;" required>
                                </div>
                                <div class="form-group">
                                    <select name="department_id" class="form-control" style="width: 100%;">
                                        <option value="">Select Department</option>
                                        @foreach ($deps as $item)
                                            <option value="{{ $dep->id }}">{{ $dep->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="organization_phone"> Phone Number</label>
                                    <input type="text" id="phone" class="form-control phone" name="phone" required
                                        style="width: 100%;" value="998">
                                </div>
                                <div class="form-group">
                                  <div class="row">
                                    <div class="col">
                                      <label for="organization_phone"> Date Med</label>
                                      <input type="date" class="form-control" name="date_med" required
                                          style="width: 100%;">
                                    </div>
                                    <div class="col">
                                      <label for="organization_phone"> Date Vacation</label>
                                      <input type="date" class="form-control" name="date_vac" required
                                          style="width: 100%;">
                                    </div>
                                  </div>
                                    
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn  btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn  btn-primary">Save </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="card-body p-0">
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover m-b-0">
                                <thead>
                                    <tr>
                                        <th><span>Name</span></th>
                                        <th width="250"><span>Department</span></th>
                                        <th width="200"><span>Phone</span></th>
                                        <th width="120"><span>Date Vacation</span></th>
                                        <th width="120"><span>Status</span></th>
                                        <th class="text-center" width="250"><span>Action</span></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cadry as $item)
                                        <tr>
                                            <td>{{ $item->fullname }}</td>
                                            <td>{{ $item->department }}</td>
                                            <td>{{ $item->phone }}</td>
                                            <td>{{ $item->date_vac2->format('d-m-Y') }}</td>
                                            <td>
                                                @if ($item->date_vac2 > now())
                                                    @if ($item->date_vac2->diffInDays() + 1 > 5)
                                                        <span class="badge badge-primary">
                                                            {{ $item->date_vac2->diffInDays() + 1 }} days left</span>
                                                    @else
                                                        <span class="badge badge-warning">
                                                            {{ $item->date_vac2->diffInDays() + 1 }} days left</span>
                                                    @endif
                                                @else
                                                    <span class="badge badge-danger">Expired<span class="ms-1 fas fa-ban"
                                                            data-fa-transform="shrink-2"></span></span>
                                                @endif
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-icon btn-outline-success"
                                                    title="Success" data-toggle="modal"
                                                    data-target="#succmodal{{ $item->id }}"><i
                                                        class="fa fa-check"></i></button>
                                                <button type="button" class="btn btn-icon btn-outline-secondary"
                                                    title="Edit" data-toggle="modal"
                                                    data-target="#editmodal{{ $item->id }}"><i
                                                        class="fa fa-edit"></i></button>
                                                <button type="button" class="btn btn-icon btn-outline-danger" title="Delete"
                                                    data-toggle="modal" data-target="#deletemodal{{ $item->id }}"><i
                                                        class="fa fa-trash-alt"></i></button>
                                                <button type="button" class="btn  btn-icon btn-outline-primary"
                                                    title="Send Sms" data-toggle="modal"
                                                    data-target="#sendmodal{{ $item->id }}"><i
                                                        class="fa fa-paper-plane"></i></button>
                                            </td>
                                        </tr>

                                        <div id="succmodal{{ $item->id }}" class="modal fade" tabindex="-1"
                                            role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <form action="{{ route('success_user') }}" method="get">
                                                @csrf
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalCenterTitle">Success
                                                                User</h5>
                                                            <button type="button" class="close"
                                                                data-dismiss="modal" aria-label="Close"><span
                                                                    aria-hidden="true">&times;</span></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <input type="hidden" name="iduser"
                                                                    value="{{ $item->id }}">
                                                                <input type="text" class="form-control"
                                                                    value="{{ $item->fullname }}" readonly
                                                                    style="width: 100%;" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="custom-control custom-switch">
                                                                    <input type="checkbox" class="custom-control-input"
                                                                        id="customswitch1" onclick="myFunction()">
                                                                    <label class="custom-control-label"
                                                                        for="customswitch1">Update Date</label>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="organization_phone"> Date</label>
                                                                <input type="date" class="form-control" readonly="true"
                                                                    id="date_vacation" name="date_vacation"
                                                                    value="{{ $item->date_vacation->addYear()->format('Y-m-d') }}"
                                                                    required style="width: 100%;">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn  btn-secondary"
                                                                data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn  btn-success">Submit </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>

                                        <div id="editmodal{{ $item->id }}" class="modal fade" tabindex="-1"
                                            role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <form action="{{ route('edit_user') }}" method="get">
                                                @csrf
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalCenterTitle">Edit
                                                                User</h5>
                                                            <button type="button" class="close"
                                                                data-dismiss="modal" aria-label="Close"><span
                                                                    aria-hidden="true">&times;</span></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <input type="hidden" name="iduseredit"
                                                                    value="{{ $item->id }}">
                                                                <label for="edtname">Fullname</label>
                                                                <input type="text" class="form-control" id="editname"
                                                                    name="nameedit" value="{{ $item->fullname }}"
                                                                    style="width: 100%;" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="departmentedit">Department</label>
                                                                <input type="text" class="form-control"
                                                                    id="departmentedit" value="{{ $item->department }}"
                                                                    name="departmentedit" style="width: 100%;" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="organization_phone"> Phone Number</label>
                                                                <input type="text" id="phone2" class="form-control"
                                                                    name="phone2" required value="{{ $item->phone }}"
                                                                    style="width: 100%;">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="organization_phone"> Date</label>
                                                                <input type="date" class="form-control" name="date_vac"
                                                                    value="{{ $item->date_vacation->format('Y-m-d') }}"
                                                                    required style="width: 100%;">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn  btn-secondary"
                                                                data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn  btn-success">Submit </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>

                                        <div id="deletemodal{{ $item->id }}" class="modal fade" tabindex="-1"
                                            role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <form action="{{ route('delete_user') }}" method="get">
                                                @csrf
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalCenterTitle">Delete
                                                                User</h5>
                                                            <button type="button" class="close"
                                                                data-dismiss="modal" aria-label="Close"><span
                                                                    aria-hidden="true">&times;</span></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <input type="hidden" name="iduserdelete"
                                                                    value="{{ $item->id }}">
                                                                <h4><code> {{ $item->fullname }} </code></h4>
                                                            </div>
                                                            <div class="form-group">
                                                                <h4>
                                                                    Do you really want to delete?
                                                                </h4>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn  btn-secondary"
                                                                data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn  btn-danger">Delete </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>

                                        <div id="sendmodal{{ $item->id }}" class="modal fade" tabindex="-1"
                                            role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <form action="{{ route('send_message') }}" method="get">
                                                @csrf
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalCenterTitle">Send
                                                                Message</h5>
                                                            <button type="button" class="close"
                                                                data-dismiss="modal" aria-label="Close"><span
                                                                    aria-hidden="true">&times;</span></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <input type="hidden" name="idusersend"
                                                                    value="{{ $item->id }}">
                                                                <input type="hidden" name="phonesenduser"
                                                                    value="{{ $item->phone }}">
                                                                <h5><code> to:</code> {{ $item->fullname }}</h5>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="textmessage">Text Message</label>
                                                                <textarea name="textmessage" class="form-control" id="textmessage" style="width: 100%" required></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn  btn-secondary"
                                                                data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn  btn-success">Submit </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $cadry->withQueryString()->links() }}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('.phone').inputmask('+999(99)-999-99-99');
        });
    </script>

    <script type="text/javascript">
        $("#success-alert").fadeTo(2000, 500).slideUp(500, function() {
            $("#success-alert").slideUp(500);
        });
    </script>

    <script>
        function myFunction() {
            var checkBox = document.getElementById("customswitch1");
            var date_vacation = document.getElementById("date_vacation");

            if (checkBox.checked == true) {
                $("#date_vacation").prop('readonly', false);
            } else {
                $("#date_vacation").prop('readonly', true);
            }
        }
    </script>
@endsection
