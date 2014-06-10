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
    <li class="active">District vaccine arrival</li>
</ol>
@stop

@section('contents')
<form method="post" action="{{ url('') }}" id="addsscc">
    <div class="form-group">
        <span class="help-block">Scan/Write the Package Number From Received Packages</span>
        <input type="text" name="sscc" placeholder="Package Number" required="">
        <button type="submit">Add</button>
        <a href="{{ url('district_package/receive/list') }}" class="pull-right btn btn-primary">
            <i class="fa fa-list-ul"></i> List
        </a>
    </div>
</form>

    <div id="output">

    </div>

<script>
    $(document).ready(function (){

        $(".dat").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat:"yy-mm-dd"
        });

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
<!--            setTimeout(function() {-->
<!--                $("#output").html("");-->
<!--            }, 3000);-->
<!--            $("#listuser").load("--><?php //echo url("manubarcode/list") ?><!--")-->
        }
    });
</script>

@stop