<div class="col-sm-12" id="add" style="margin-top: 20px">

    <div class="col-sm-2">
        <b>GTIN</b><br>
        {{ $package->GTIN }}
    </div>
    <div class="col-sm-1">
        <b>Item</b><br>
        {{ $package->vaccine->name }}
    </div>
    <div class="col-sm-2">
        <b>Lot Number</b><br>
        {{ $package->lot_number }}
    </div>
    <div class="col-sm-2">
        Expiry Date <br>
        {{ date('j M Y',strtotime($package->expiry_date)) }}
    </div>
    {{ Form::open(array("url"=>url("package/stock/count"),"class"=>"form-horizontal","id"=>'countform')) }}
    <div class="col-sm-2">
        <input type="hidden" name="lot" value="{{ $package->lot_number }}" />
        <input type="hidden" name="GTIN" value="{{ $package->GTIN }}" />
        <input type="hidden" name="period" value="{{ $period }}" />
        Vials:
        <input title="" required="" name="vials" pattern="\d*" type="text" class="form-control input-sm" placeholder="Number of vials">
    </div>
    <div class="col-sm-2">
        Boxes:
        <input title="" required="" name="box" pattern="\d*" type="text" class="form-control input-sm" placeholder="Number of  boxes">
    </div>
    <div class="col-sm-1">
        <br>
        <input type="submit" value="Submit" class="btn btn-success btn-sm">
    </div>
    {{ Form::close() }}
</div>



<script>
    $(document).ready(function (){


//        $("input[name=lot]").focus();
        $('#countform').on('submit', function(e) {
            e.preventDefault();
            $("#output").html("<h4><i class='fa fa-spin fa-spinner '></i><span>Submitting please wait...</span><h4>");
            $(this).ajaxSubmit({
                target: '#output',
                success:  afterSuccess
            });

        });

        function afterSuccess(){
            $('#countform').resetForm();
            $("#output").fadeOut( "slow", function() {
                $("#output").html("").fadeIn();
            });
            $("#listuser").load("<?php echo url("package/inventory/list") ?>")
        }
    });
</script>