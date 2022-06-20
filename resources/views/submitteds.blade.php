@extends('layouts.master')

@section('content')

    <div class="col-12">
        <div class="card table-card">
            <div class="card-header">

                <div class="form-inline">
                    <div class="form-group mx-sm-3">
                        <form action="{{ route('departments') }}" method="get">
                            @csrf
                            <input class="form-control form-control-sm" value="{{ request()->query('search') }}"
                                name="search" type="search" placeholder="search ..." />
                        </form>
                    </div>
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
                <form action="{{ route('add_department') }}" method="post">
                    @csrf
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalCenterTitle">Add Department</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="name" placeholder="Department name"
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
                                        <th><span>Fullname</span></th>
                                        <th><span>Department</span></th>
                                        <th><span class="text-primary">Period</span></th>
                                        <th><span class="text-primary">DateVac</span></th>
                                        <th><span class="text-primary">Result</span></th>
                                        <th><span>Send User</span></th>
                                        <th><span>Rec User</span></th>
                                        <th><span>DateTime</span></th>
                                        <th class="text-center" width="200px"><span>Action</span></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($submitteds as $item)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $item->cadry->fullname }}</td>
                                            <td>{{ $item->cadry->department->name }}</td>
                                            <td>{{ $item->per1 }} , {{ $item->per2 }}</td>
                                            <td>{{ $item->todate }} , {{ $item->fromdate }}</td>
                                            <td>{{ $item->resultdays }}</td>
                                            <td>{{ $item->user_send->name }}</td>
                                            <td>{{ $item->user_rec->name }}</td>
                                            <td>{{ $item->updated_at }}</td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-success btn-sm"><i class="fas fa-check-circle"></i></button>
                                                <button type="button" class="btn btn-warning btn-sm"><i class="fas fa-minus-circle"></i></button>
                                                <a href="{{route('exportVacationToDoc',['id' => $item->id])}}" type="button" class="btn btn-primary btn-sm"><i class="fas fa-file-download"></i></a>
                                                <button type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                            </td>
                                        </tr>

                                    @endforeach
                                </tbody>
                            </table>
                            {{ $submitteds->withQueryString()->links() }}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
