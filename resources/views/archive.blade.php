@extends('layouts.master')

@section('content')

  @if (\Session::has('msg'))
    @if (Session::get('msg') == 1)
      <div class="alert alert-success" id = "success-alert">Succesfully!</div>
    @else
      <div class="alert alert-danger" id = "success-alert2">Not Success!</div>
    @endif
  @endif

<div class="col">
    <div class="card table-card">
      <div class="card-header">
        
        <div class="form-inline">
          <div class="form-group mx-sm-3 mb-2">
             <input type="text" class="form-control" id="search" placeholder="Search ...">
          </div>
        </div>
          
        <div class="card-header-right">
          <div class="btn-group card-option">
            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="feather icon-more-horizontal"></i>
            </button>
          <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right">
              <li class="dropdown-item full-card"><a href="#!"><span><i class="feather icon-maximize"></i> maximize</span><span style="display:none"><i class="feather icon-minimize"></i> Restore</span></a></li>
              <li class="dropdown-item minimize-card"><a href="#!"><span><i class="feather icon-minus"></i> collapse</span><span style="display:none"><i class="feather icon-plus"></i> expand</span></a></li>
              <li class="dropdown-item reload-card"><a href="#!"><i class="feather icon-refresh-cw"></i> reload</a></li>
              <li class="dropdown-item close-card"><a href="#!"><i class="feather icon-file-text"></i> Export</a></li>
          </ul>
          </div>
        </div>
      </div>


        <div class="card-body p-0">
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    <div class="table-responsive">
                        <div class="customer-scroll" id="rec-table">
                            @include('includes.include-archive')
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')


@endsection