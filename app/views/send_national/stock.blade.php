@extends("layout.master")

@section('title')
<h1>
    Inventory
    <small>National Inventory Management </small>
</h1>
@stop
@section('contents')
<div class="col-sm-12">
    <div class="col-sm-4">
     <h4>Facility: <span class="lead">National Store</span></h4>

    </div>
    <div class="col-sm-4">
        <h4>Target Population <span class="lead">42,000,000</span></h4>
    </div>
    <div class="col-sm-4">
        <h4>Entered By <span class="lead"> {{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</span></h4>
    </div>
</div>
<div class="col-sm-12">
    <div class="col-sm-7">
        <div class="col-sm-4"><h4>Enter Lot Number</h4></div>
        <div class="col-sm-7">
            <input type="text" name="lot" class="form-control" placeholder="Lot Number">
        </div>
    </div>
    <div class="col-sm-5">
        <div class="col-sm-5"><h4>Reporting Period</h4></div>
        <div class="col-sm-7">
            <input type="text" name="period" class="dat form-control" value="{{ date('Y-m-d') }}">
        </div>
    </div>
</div>

<script>
    $(document).ready(function (){

        $(".dat").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat:"yy-mm-dd"
        });

        $("input[name=lot]").focus();
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
            $('#addsscc').resetForm();
        }
    });
</script>
@stop