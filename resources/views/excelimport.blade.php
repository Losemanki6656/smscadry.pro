@extends('layouts.master')

@section('content')

<form action="{{route('excelimportsuccess')}}" method="post" enctype="multipart/form-data">
@csrf
<input type="file" class="form-control" name="ecel1">
<input type="file" class="form-control" name="ecel2">
<p></p>
<button type="submit" class="btn btn-primary">Send File</button>
</form>

@endsection

@section('scripts')
@endsection
