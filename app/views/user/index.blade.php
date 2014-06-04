@extends("layout.master")

@section('breadcumb')
<ol class="breadcrumb">
<li>
    <a href="{{ url('home') }}">Dashboard</a>
</li>
<li class="active">Users</li>
</ol>
@stop

@section('contents')
<div class="row">
    <div class="col-md-7" id="listuser">
        @include('user.list')
    </div>
    <div class="col-md-5" id="adduser">
        @include('user.add')
    </div>
</div>

@stop