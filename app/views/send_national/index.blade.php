@extends("layout.master")

@section('title')
<h1>
    Send Package
    <small>Prepare and send package to regions </small>
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
    <div class="form-group col-sm-6">
        <span class="help-block">Region of Destination</span>
        {{ Form::select('region',array(""=>"Select Region")+Region::all()->lists('region','id'),'',array('class'=>'form-control','required'=>'requiered')) }}
    </div>


    <div id="output"class="col-sm-12">

    </div>

<div id="listuser"></div>

<script>
    $(document).ready(function (){

        $("select[name=region]").click(function(){
            $("#output").html("<h4><i class='fa fa-spin fa-spinner '></i><span>Getting area information please wait...</span><h4>");
            $("#output").load('<?php echo url('package/prepare/areainfo') ?>/'+$(this).val(),function(){

            });
        })

        function afterSuccess(){
            $('#addsscc input[name=sscc]').val("");
<!--            setTimeout(function() {-->
<!--                $("#output").html("");-->
<!--            }, 3000);-->
<!--            $("#listuser").load("--><?php //echo url("manubarcode/list") ?><!--")-->
        }
    });
</script>

@stop