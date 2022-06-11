@extends('layouts.master')

@section('content')

    @if (\Session::has('msg'))
        @if (Session::get('msg') == 1)
            <div class="alert alert-success" id="success-alert">Succesfully!</div>
        @else
            <div class="alert alert-danger" id="success-alert2">Not Success!</div>
        @endif
    @endif

    <div class="col-8">
        <div class="card table-card">
            <div class="card-header">

                <div class="form-inline">
                    <div class="form-group mx-sm-3">
                        <form action="{{ route('holidays') }}" method="get">
                            @csrf
                            <input class="form-control form-control-sm" value="{{ request()->query('search') }}"
                                name="search" type="search" placeholder="search ..." />
                        </form>
                    </div>
                    <button type="button" class="btn btn-primary btn-sm mr-2" data-toggle="modal"
                        data-target="#exampleModalCenter"><i class="fa fa-plus mr-2"></i>Add Holiday</button>
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
                <form action="{{ route('add_holiday') }}" method="post">
                    @csrf
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalCenterTitle">Add Holiday</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Holiday name</label>
                                    <input type="text" class="form-control" name="name" placeholder="Holiday name"
                                        style="width: 100%;" required>
                                </div>
                                <div class="form-group">
                                    <label> Holiday date</label>
                                    <input type="date" class="form-control" name="date_holiday" placeholder="Department name"
                                        style="width: 100%;" required>
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
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th width="80px"><span>#</span></th>
                                        <th><span>Holiday Name</span></th>
                                        <th><span>Holiday Date</span></th>
                                        <th class="text-center" width="100px"><span>Action</span></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($deps as $item)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->date_holiday }}</td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-secondary btn-sm mr-2" data-toggle="modal"
                                                     data-target="#editmodal{{ $item->id }}"><i class="fa fa-edit"></i></button>
                                            </td>
                                        </tr>

                                        <div id="editmodal{{ $item->id }}" class="modal fade" tabindex="-1"
                                            role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <form action="{{ route('edit_holiday', ['id' => $item->id]) }}" method="get">
                                                @csrf
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalCenterTitle">Edit
                                                                Holiday</h5>
                                                            <button type="button" class="close"
                                                                data-dismiss="modal" aria-label="Close"><span
                                                                    aria-hidden="true">&times;</span></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" name="name"
                                                                    style="width: 100%;" value="{{$item->name}}" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <input type="date" class="form-control" name="date_holiday"
                                                                    style="width: 100%;" value="{{$item->date_holiday}}" required>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <a type="button" class="btn  btn-danger" href="{{ route('delete_holiday', ['id' => $item->id]) }}">Delete</a>
                                                            <button type="button" class="btn  btn-secondary"
                                                                data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn  btn-success"> Edit </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>

                                    @endforeach
                                </tbody>
                            </table>
                            {{ $deps->withQueryString()->links() }}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
