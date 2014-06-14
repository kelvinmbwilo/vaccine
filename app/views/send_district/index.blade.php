@extends("layout.master")

@section('title')
<h1>
    Send Package
    <small>Prepare and send package to facilities </small>
</h1>
@stop
@section('breadcumb')
<ol class="breadcrumb">
    <li>
        <a href="{{ url('home') }}">Dashboard</a>
    </li>
    <li class="active">Prepare Package</li>
</ol>
@stop

@section('contents')
    <div class="form-group col-sm-3">
        <span class="help-block">District</span>
        {{ Form::select('region',Auth::user()->district->facility->lists('name','id'),'',array('class'=>'form-control','required'=>'requiered')) }}
    </div>
    <div id="output"class="col-sm-9">

    </div>
<div id="itemarea" class="col-sm-12" ></div>
<div id="listuser" class="col-sm-12" style="margin-top: 20"></div>

<script>
    $(document).ready(function (){

        $("select[name=region]").click(function(){
            $("#output").html("<h4><i class='fa fa-spin fa-spinner '></i><span>Getting area information please wait...</span><h4>");
            $("#output").load('<?php echo url('district_package/prepare/areainfo') ?>/'+$(this).val(),function(){
                $("#itemarea").html("");
                $("#listuser").html("")
            });
        })

    });
</script>

@stop