@extends("layout.master")

@section('title')
<h1>
    Package Arrival
    <small>{{ Auth::user()->district->district }} District vaccine arrival </small>
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
<div class="col-sm-12" style="margin-bottom: 20px">
<form method="post" action="{{ url('') }}" id="addsscc">
    <div class="form-group" >
        <div class="col-sm-6">
            Scan Shipment Number<br>
            <input type="text" name="sscc" placeholder="Scan Shipment Number" required class="form-control">
        </div>
        <div class="col-sm-6">
            <br><button type="submit" class="btn btn-info btn-min">Submit</button>
        </div>
    </div>
</form>
</div>
    <div id="output" style="margin-top: 20px">

    </div>

<script>
    $(document).ready(function (){

        $(".dat").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat:"yy-mm-dd"
        });

        $("input[name=sscc]").focus();
        $('#addsscc').on('submit', function(e) {
            e.preventDefault();
            $("#output").html("<h4><i class='fa fa-spin fa-spinner '></i><span>Retriving package information please wait...</span><h4>");
            $(this).ajaxSubmit({
                url : '<?php echo url('district_package/receive/sscc') ?>/'+$('input[name=sscc]').val(),
                target: '#output',
                success:  afterSuccess
            });

        });

        function afterSuccess(){
            $('#addsscc').resetForm();
        }
    });
</script>
@stop