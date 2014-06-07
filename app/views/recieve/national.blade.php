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
<script>
    $(document).ready(function (){

        $(".dat").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat:"yy-mm-dd"
        });

        $('#FileUploader').on('submit', function(e) {
            e.preventDefault();
            $("#output").html("<h3><i class='fa fa-spin fa-spinner '></i><span>Making changes please wait...</span><h3>");
            $(this).ajaxSubmit({
                target: '#output',
                success:  afterSuccess
            });

        });

        function afterSuccess(){
            $('#FileUploader').resetForm();
            setTimeout(function() {
                $("#output").html("");
            }, 3000);
            $("#listuser").load("<?php echo url("manubarcode/list") ?>")
        }
    });
</script>

@stop