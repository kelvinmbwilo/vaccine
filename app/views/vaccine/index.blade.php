@extends("layout.master")

@section('title')
<h1>
    Vaccine/Diluent Management
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
<ul id="myTab" class="nav nav-tabs">
    <li class="active"><a href="#home" data-toggle="tab">Vaccine</a></li>
    <li><a href="#profile" data-toggle="tab">Diluent</a></li>
</ul>
<div id="myTabContent" class="tab-content">
    <div class="tab-pane fade in active" id="home">
        <div class="col-md-7" id="listuser">
            @include('vaccine.list')
        </div>
        <div class="col-md-5" id="adduser">
            @include('vaccine.add')
        </div>
    </div>
    <div class="tab-pane fade" id="profile">
        <div class="col-md-7" id="listduser">
            @include('diluent.list')
        </div>
        <div class="col-md-5" id="addduser">
            @include('diluent.add')
        </div>
    </div>
</div>

@stop