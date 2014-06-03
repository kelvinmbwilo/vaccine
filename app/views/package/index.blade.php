@extends("layout.master")

@section('title')
<h1>
    Package Management
    <small>Prepare, Receive and Send Packages</small>
</h1>
@stop
@section('breadcumb')
<ol class="breadcrumb">
    <li>
        <a href="{{ url('home') }}">Dashboard</a>
    </li>
    <li class="active">Packages</li>
</ol>
@stop

@section('contents')
<div class="row">
    <div class="col-md-7" id="listuser">
        @include('package.receive')
    </div>
</div>

@stop