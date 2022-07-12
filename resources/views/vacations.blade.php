@extends('layouts.master')

@section('content')
    <div class="col">
        <div class="card table-card">
            <div class="card-header">

                <div class="form-inline">
                    <div class="form-group mx-sm-3">
                        <form action="{{ route('vacations') }}" method="get">
                            @csrf
                            <input class="form-control form-control-sm" value="{{ request()->query('search') }}"
                                name="search" type="search" placeholder="search ..." />
                        </form>
                    </div>
                    <form action="{{ route('vacations') }}" method="get">
                        <button type="submit" name="filter" value="filter" class="btn btn-danger btn-sm mr-2"><i
                                class="fa fa-filter mr-2"></i>Filter</button>
                    </form>


                </div>

                <div class="card-header-right">
                    <div class="btn-group card-option">
                        <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <i class="feather icon-more-horizontal"></i>
                        </button>
                        <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right">
                            <li class="dropdown-item full-card"><a href="#!"><span><i
                                            class="feather icon-maximize"></i>
                                        maximize</span><span style="display:none"><i class="feather icon-minimize"></i>
                                        Restore</span></a></li>
                            <li class="dropdown-item minimize-card"><a href="#!"><span><i
                                            class="feather icon-minus"></i>
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
        </div>

        <div class="card p-0">
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th><span>Name</span></th>
                                    <th width="230"><span>date1</span></th>
                                    <th width="200"><span>date2</span></th>
                                    <th width="200"><span>MainDay</span></th>
                                    <th width="160"><span>status1</span></th>
                                    <th width="160"><span>status1</span></th>
                                    <th class="text-center" width="180">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cadry as $item)
                                    <tr>
                                        <td>#</td>
                                        <td>{{ $item->cadry->fullname }}</td>
                                        <td>{{ $item->date1->format('Y-m-d') }}</td>
                                        <td>{{ $item->date2->format('Y-m-d') }}</td>
                                        <td>
                                            {{ $item->date2->diffInDays($item->date1)}} kun</td>
                                        <td class="text-center"> 
                                            @if ($item->status1)
                                                <input type="checkbox" class="form-check-input" checked>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->status2)
                                                <input type="checkbox" class="form-check-input" checked>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->status1 == false)
                                                <a type="button" href="{{route('send_sms_to_vac',['id' => $item->id])}}" class="btn btn-primary btn-sm">Sms</a>
                                                <button class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#edit{{ $item->id }}">Edit</button>
                                            @else
                                                 <a href="{{route('delete_vac',['id' => $item->id])}}" class="btn btn-danger btn-sm">Delete</a>
                                            @endif
                                        </td>
                                    </tr>
                                    <div id="edit{{ $item->id }}" class="modal fade" tabindex="-1"
                                        role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <form action="{{ route('update_vacation_cadry', ['id' => $item->id]) }}"
                                            method="post">
                                            @csrf
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalCenterTitle">Update
                                                            Vacation Cadry</h5>
                                                        <button type="button" class="close"
                                                            data-dismiss="modal" aria-label="Close"><span
                                                                aria-hidden="true">&times;</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control"
                                                                value="{{ $item->cadry->fullname }}" readonly
                                                                style="width: 100%;" required>
                                                        </div>
                                                        <div>
                                                            <div class="row">
                                                                <div class="col">
                                                                    <label> Date 1</label>
                                                                    <input type="date" class="form-control" name="date1" value="{{ $item->date1->format('Y-m-d') }}"
                                                                        required style="width: 100%;">
                                                                </div>
                                                                <div class="col">
                                                                    <label> Date 2</label>
                                                                    <input type="date" class="form-control" name="date2" value="{{ $item->date2->format('Y-m-d') }}"
                                                                        required style="width: 100%;">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            
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
                    </div>
                    <div class="mr-5 ml-5">
                        <div class="row mb-3">
                            <div class="col d-flex justify-content mt-3">
                                <h6 class="mt-2 mr-2">Show</h6>
                                <select class="form-control" style="width: 80px" name="select_paginate"
                                    id="select_paginate">
                                    <option value="10" @if (request('paginate') == 10) selected @endif>10</option>
                                    <option value="50" @if (request('paginate') == 50) selected @endif>50</option>
                                    <option value="100" @if (request('paginate') == 100) selected @endif>100</option>
                                </select>
                                <h6 class="mt-2 ml-2">entries</h6>
                            </div>
                            <div class="col d-flex justify-content-end mt-3">
                                {{ $cadry->withQueryString()->links() }}
                            </div>
                            @push('scripts')
                                <script>
                                    $('#select_paginate').change(function(e) {
                                        let paginate = $(this).val();
                                        let url = '{{ route('vacations') }}';
                                        window.location.href = `${url}?paginate=${paginate}`;
                                    })
                                </script>
                            @endpush
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
            @if (\Session::has('msg'))
                @if (Session::get('msg') == 1)
                    alertify.success('Worker successfully added !');
                @elseif(Session::get('msg') == 2)
                    alertify.success('send success');
                @elseif (Session::get('msg') == 3)
                    alertify.warning('Not Send');
                @elseif (Session::get('msg') == 4)
                    alertify.warning('Successfully deleted');
                @endif
            @endif
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.phone').inputmask('(99)-999-99-99');
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
