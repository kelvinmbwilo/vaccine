@extends("layout.master")

@section('title')
<h1>
    Package Arrival
    <small>National vaccine arrival report</small>
</h1>
@stop
@section('breadcumb')
<ol class="breadcrumb">
    <li>
        <a href="{{ url('home') }}">Dashboard</a>
    </li>
    <li class="active">vaccine arrival</li>
</ol>
@stop

@section('contents')
<div class="row">
    <div class="col-md-10 col-md-offset-1" id="listroles">
        <div class='form-group'>
            <div class='col-sm-6'>
                Manufacture Date <br>  {{ Form::text('manu','',array('class'=>'dat form-control','placeholder'=>'Manufacture Date','required'=>'required')) }}
            </div>
            <div class='col-sm-6'>
                Expiry Date <br>  {{ Form::text('exp','',array('class'=>'dat form-control','placeholder'=>'Expiry Date','required'=>'required')) }}
            </div>
        </div>
    </div>
</div>

@stop