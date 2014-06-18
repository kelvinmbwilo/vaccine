@extends("layout.master")

@section('title')
<h1>
    Package Arrival
    <small>National vaccine arrival </small>
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
<div class="col-sm-12" id="infoarea"></div>
<div class="col-sm-12" style="margin-bottom: 20px" id="ssccarea">
<form method="post" action="{{ url('') }}" id="addsscc">
    <div class="form-group" >
        <div class="col-sm-6">
           Scan the SSCC <br>
            <input type="text" name="sscc" placeholder="Scan Package SSCC Number" required class="form-control">
        </div>
        <div class="col-sm-6">
            <br><button type="submit" class="btn btn-info btn-min">Scan</button>
        </div>
    </div>
</form>
</div>
    <div id="output" style="margin-top: 20px">

    </div>

<script>
    $(document).ready(function (){
$("#infoarea").hide();
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
                url : '<?php echo url('package/receive/sscc') ?>/'+$('input[name=sscc]').val(),
                target: '#output',
                success:  afterSuccess
            });

        });

        function afterSuccess(){
            var ssc = $('#addsscc input[name=sscc]').val();
            $('#addsscc').resetForm();
            var discr = "<p class='lead'>SSCC: "+ssc+"  <button class='btn btn-xs btn-warning' id='canc'>Cancel</button> </p> ";
            $("#ssccarea").fadeOut("500")
            $("#infoarea").html(discr).fadeIn("slow");
            $("#canc").click(function(){
                $("#infoarea").html("").fadeOut("500")
                $("#output").html("").fadeOut("500")
                $("#ssccarea").fadeIn("slow");
            })
        }
    });
</script>
@stop