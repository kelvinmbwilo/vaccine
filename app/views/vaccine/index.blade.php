@extends("layout.master")

@section('title')
<h1>
    Vaccine Management
    <small>Add, Edit and Delete Vaccines</small>
</h1>
@stop
@section('breadcumb')
<ol class="breadcrumb">
<li>
    <a href="{{ url('home') }}">Dashboard</a>
</li>
<li class="active">Vaccines</li>
</ol>
@stop

@section('contents')
<div class="row">
    <div class="col-md-7" id="listuser">
        @include('vaccine.list')
    </div>
    <div class="col-md-5" id="adduser">
        @include('vaccine.add')
    </div>
</div>

@stop