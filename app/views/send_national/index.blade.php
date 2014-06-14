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
<form method="post" action="{{ url('') }}" id="addsscc">
    <div class="form-group col-sm-6">
        <span class="help-block">Region of Destination</span>
        {{ Form::select('region',array(""=>"Select Region")+Region::all()->lists('region','id'),'',array('class'=>'form-control','required'=>'requiered')) }}
    </div>
<!--    <div class="form-group  col-sm-5" id="lotarea">-->
<!--        <span class="help-block">Scan/Write the Lot Number Of Package</span>-->
<!--        <input type="text" name="sscc" placeholder="Lot Number" required="required" style="height: 34px">-->
<!--        <input type="hidden" name="id" value="first" />-->
<!--        <button type="submit" class="btn btn-primary">Scan</button>-->
<!--        <a href="{{ url('package/receive/list') }}" class="pull-right btn btn-primary">-->
<!--<!--            <i class="fa fa-list-ul"></i> List Sent Packages-->-->
<!--        </a>-->
<!--    </div>-->
</form>

    <div id="output">

    </div>

<div id="listuser"></div>

<script>
    $(document).ready(function (){

        $('#addsscc').on('submit', function(e) {
            e.preventDefault();
            $("#output").html("<h4><i class='fa fa-spin fa-spinner '></i><span>Retriving stock information please wait...</span><h4>");
            $(this).ajaxSubmit({
                url : '<?php echo url('package/prepare/') ?>/'+$('input[name=sscc]').val(),
                target: '#output',
                success:  afterSuccess
            });

        });

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