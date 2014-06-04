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
    <div class="col-md-12" id="listuser">
            @if(Auth::user()->role_id=="national")
                @include("send_package.national")
            @elseif(Auth::user()->role_id=="admin")
                @include("send_package.national")
            @elseif(Auth::user()->role_id=="region")
                @include("send_package.region")
             @else
             @endif
    </div>
</div>

@stop